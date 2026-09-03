/**
 * Visor 3D Profesional de Productos
 * Permite rotación frontal/trasera, zoom y controles táctiles
 */
class ProductViewer {
    constructor(container, options = {}) {
        this.container = container;
        this.options = {
            frontImage: options.frontImage || '',
            backImage: options.backImage || '',
            autoRotate: options.autoRotate || false,
            zoomLevel: options.zoomLevel || 2,
            rotationSpeed: options.rotationSpeed || 0.5,
            ...options
        };
        
        this.currentView = 'front';
        this.isRotating = false;
        this.isZoomed = false;
        this.isDragging = false;
        this.startX = 0;
        this.startY = 0;
        this.translateX = 0;
        this.translateY = 0;
        
        this.init();
    }
    
    init() {
        this.createViewer();
        this.bindEvents();
        if (this.options.autoRotate) {
            this.startAutoRotation();
        }
    }
    
    createViewer() {
        this.container.innerHTML = `
            <div class="product-viewer">
                <div class="viewer-container">
                    <div class="image-wrapper">
                        <img class="product-image front-image active" 
                             src="${this.options.frontImage}" 
                             alt="Vista frontal" 
                             draggable="false"
                             loading="eager"
                             decoding="async"
                             fetchpriority="high">
                        <img class="product-image back-image" 
                             src="${this.options.backImage}" 
                             alt="Vista trasera" 
                             draggable="false"
                             loading="eager"
                             decoding="async"
                             fetchpriority="high">
                        <div class="loading-spinner">
                            <div class="spinner"></div>
                        </div>
                    </div>
                    
                    <div class="viewer-controls">
                        <button class="control-btn rotate-btn" title="Rotar vista">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                    
                    <div class="view-indicator">
                        <span class="indicator-dot front-dot active"></span>
                        <span class="indicator-dot back-dot"></span>
                    </div>

                    <div class="zoom-hint">
                        <i class="fas fa-mouse"></i>
                        <span>Haz clic para ampliar</span>
                    </div>
                </div>
            </div>
        `;
        
        this.frontImage = this.container.querySelector('.front-image');
        this.backImage = this.container.querySelector('.back-image');
        this.imageWrapper = this.container.querySelector('.image-wrapper');
        this.rotateBtn = this.container.querySelector('.rotate-btn');
        this.frontDot = this.container.querySelector('.front-dot');
        this.backDot = this.container.querySelector('.back-dot');
        this.loadingSpinner = this.container.querySelector('.loading-spinner');
        this.zoomHint = this.container.querySelector('.zoom-hint');
    }
    
    bindEvents() {
        // Rotación con botón dedicado
        if (this.rotateBtn) {
            this.rotateBtn.addEventListener('click', () => this.rotate());
        }
        
        // Zoom por clic en la imagen; doble clic también lo alterna
        this.imageWrapper.addEventListener('click', () => this.toggleZoom());
        this.imageWrapper.addEventListener('dblclick', () => this.toggleZoom());
        
        // Arrastrar cuando está en zoom
        this.imageWrapper.addEventListener('mousedown', (e) => this.startDrag(e));
        this.imageWrapper.addEventListener('mousemove', (e) => this.drag(e));
        this.imageWrapper.addEventListener('mouseup', () => this.endDrag());
        this.imageWrapper.addEventListener('mouseleave', () => this.endDrag());
        
        // Touch events para móviles
        this.imageWrapper.addEventListener('touchstart', (e) => this.startDrag(e.touches[0]));
        this.imageWrapper.addEventListener('touchmove', (e) => {
            e.preventDefault();
            this.drag(e.touches[0]);
        });
        this.imageWrapper.addEventListener('touchend', () => this.endDrag());
        
        // Wheel zoom
        this.imageWrapper.addEventListener('wheel', (e) => {
            e.preventDefault();
            if (e.deltaY < 0) {
                this.zoomIn();
            } else {
                this.zoomOut();
            }
        });
        
        // Teclado
        document.addEventListener('keydown', (e) => {
            if (this.container.querySelector('.product-viewer:hover')) {
                switch(e.key) {
                    case ' ':
                    case 'Enter':
                        e.preventDefault();
                        this.rotate();
                        break;
                    case 'z':
                    case 'Z':
                        this.toggleZoom();
                        break;
                    case 'Escape':
                        if (this.isZoomed) this.zoomOut();
                        break;
                }
            }
        });
        
        // Precargar imágenes
        this.preloadImages();
    }
    
    preloadImages() {
        const images = [this.options.frontImage, this.options.backImage];
        let loadedCount = 0;
        
        images.forEach(src => {
            if (src) {
                const img = new Image();
                img.onload = () => {
                    loadedCount++;
                    if (loadedCount === images.filter(s => s).length) {
                        this.hideLoading();
                    }
                };
                img.src = src;
            }
        });
        
        // Timeout de seguridad
        setTimeout(() => this.hideLoading(), 3000);
    }
    
    hideLoading() {
        this.loadingSpinner.style.opacity = '0';
        setTimeout(() => {
            this.loadingSpinner.style.display = 'none';
        }, 300);
    }
    
    rotate() {
        // Si no hay imagen trasera definida, no rotar
        if (!this.options.backImage) return;
        if (this.isRotating) return;
        
        this.isRotating = true;
        this.rotateBtn.style.transform = 'rotate(180deg)';
        
        const currentImage = this.currentView === 'front' ? this.frontImage : this.backImage;
        const nextImage = this.currentView === 'front' ? this.backImage : this.frontImage;
        
        // Animación de rotación
        currentImage.style.transform = 'rotateY(-90deg)';
        
        setTimeout(() => {
            currentImage.classList.remove('active');
            nextImage.classList.add('active');
            nextImage.style.transform = 'rotateY(90deg)';
            
            setTimeout(() => {
                nextImage.style.transform = 'rotateY(0deg)';
                this.currentView = this.currentView === 'front' ? 'back' : 'front';
                
                // Actualizar indicadores
                this.frontDot.classList.toggle('active', this.currentView === 'front');
                this.backDot.classList.toggle('active', this.currentView === 'back');
                
                setTimeout(() => {
                    this.isRotating = false;
                    this.rotateBtn.style.transform = 'rotate(0deg)';
                }, 300);
            }, 50);
        }, 150);
    }
    
    toggleZoom() {
        if (this.isZoomed) {
            this.zoomOut();
        } else {
            this.zoomIn();
        }
    }
    
    zoomIn() {
        this.isZoomed = true;
        this.imageWrapper.classList.add('zoomed');
        
        const activeImage = this.container.querySelector('.product-image.active');
        activeImage.style.transform = `scale(${this.options.zoomLevel}) translate(${this.translateX}px, ${this.translateY}px)`;
    }
    
    zoomOut() {
        this.isZoomed = false;
        this.imageWrapper.classList.remove('zoomed');
        this.translateX = 0;
        this.translateY = 0;
        
        const activeImage = this.container.querySelector('.product-image.active');
        activeImage.style.transform = 'scale(1) translate(0px, 0px)';
    }
    
    startDrag(e) {
        if (!this.isZoomed) return;
        
        this.isDragging = true;
        this.startX = e.clientX - this.translateX;
        this.startY = e.clientY - this.translateY;
        this.imageWrapper.style.cursor = 'grabbing';
    }
    
    drag(e) {
        if (!this.isDragging || !this.isZoomed) return;
        
        this.translateX = e.clientX - this.startX;
        this.translateY = e.clientY - this.startY;
        
        // Limitar el arrastre
        const maxTranslate = 100;
        this.translateX = Math.max(-maxTranslate, Math.min(maxTranslate, this.translateX));
        this.translateY = Math.max(-maxTranslate, Math.min(maxTranslate, this.translateY));
        
        const activeImage = this.container.querySelector('.product-image.active');
        activeImage.style.transform = `scale(${this.options.zoomLevel}) translate(${this.translateX}px, ${this.translateY}px)`;
    }
    
    endDrag() {
        this.isDragging = false;
        this.imageWrapper.style.cursor = this.isZoomed ? 'grab' : 'pointer';
    }
    
    toggleFullscreen() {
        this.container.classList.toggle('fullscreen');
        const icon = this.fullscreenBtn.querySelector('i');
        
        if (this.container.classList.contains('fullscreen')) {
            icon.className = 'fas fa-compress';
            this.fullscreenBtn.title = 'Salir de pantalla completa';
        } else {
            icon.className = 'fas fa-expand';
            this.fullscreenBtn.title = 'Pantalla completa';
        }
    }
    
    startAutoRotation() {
        setInterval(() => {
            if (!this.isRotating && !this.isZoomed) {
                this.rotate();
            }
        }, 4000);
    }
}

// Inicializar visores automáticamente
document.addEventListener('DOMContentLoaded', function() {
    const viewers = document.querySelectorAll('[data-product-viewer]');
    
    viewers.forEach(container => {
        const frontImage = container.dataset.frontImage;
        const backImage = container.dataset.backImage;
        const autoRotate = container.dataset.autoRotate === 'true';
        
        new ProductViewer(container, {
            frontImage,
            backImage,
            autoRotate
        });
    });
});