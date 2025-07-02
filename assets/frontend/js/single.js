document.addEventListener('DOMContentLoaded', () => {

  if(document.querySelectorAll('.google-testimonals')){
    let googleTestimonalsSwiper = new Swiper('.google-testimonals', {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      navigation: {
        nextEl: '.google-testimonals-next',
        prevEl: '.google-testimonals-prev',
      },
      pagination: {
        el: '.google-testimonals-pagination',
        clickable: true,
      },
    })

  }
  if (document.querySelector('.gallery-thumbnail-container')) {
    var swiper = new Swiper(".mySwiper", {
        //loop: true,
        spaceBetween: 20,
        slidesPerView: 2,
        centerInsufficientSlides: true,
        lazy: true,
        breakpoints: {
          768:{
        slidesPerView: 2,
          },
          1024: {
            slidesPerView: 4,
          }  
        },
        freeMode: true,
        watchSlidesProgress: true,
      });
      var swiper2 = new Swiper(".mySwiper2", {
       // loop: true,
        lazy: true,
        spaceBetween: 10,
        virtual: true,
        watchSlidesProgress: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        thumbs: {
          swiper: swiper,
        },
      });
}
if(document.querySelector('.gallery-grid')){
    var galleryGrid = new Swiper(".gallery-grid", {
        slidesPerView: 2,
        lazy: true,
       
        grid: {
          rows: 2,
          fill: "row"
        },
        spaceBetween: 20,
        navigation: {
          nextEl: ".gallery-button-next",
          prevEl: ".gallery-button-prev",
        }
      });
      const rehab_lightboxs = document.querySelectorAll('.gallery-grid-container .rehab_lightbox');
      const modalGalleryContainer = document.querySelector('.modal-gallery-container');
      const modalImage = document.querySelector('.modal-image-body img');
      const modalClose = document.querySelector('.close-modal');
      const youtubeKey = addic_clinic_ajax.video;
      console.log(youtubeKey);
      const rehabvideoplaheholder = document.querySelector('#rehab-video-plaheholder');
      const video = document.querySelector('.rehab-video-container .rehab-video'),
            videoItem = document.getElementById('rehab-video');
            
      
      if(rehabvideoplaheholder){
        let videPlayer;
        let isPlaying = false;
        const height = videoItem.clientHeight,
        width = videoItem.clientWidth
      
        
        window.YT.ready(function(){

          function onYouTubeIframeAPIReady() {
    
            
            videId = videoItem.dataset.videoid;
            console.log(videId);
            videPlayer =  new YT.Player('rehab-video',{
              height: height,
              width: width,
              videoId: videId, // Reemplaza con el ID del video de YouTube
              playerVars: {
                  autoplay: 0, // Reproducir automáticamente
                  controls: 0,  // Mostrar controles
                  listType: '', // No cargar una playlist
                  rel: 0,       // No mostrar videos relacionados al final
                  showinfo: 0,  // (Obsoleto, pero en algunos casos ayuda)
                  modestbranding: 0 // Oculta el logo de YouTube
              },
              events: {
                'onStateChange': onPlayerStateChange
              }
            })
          }
          onYouTubeIframeAPIReady() 
          function  onPlayerStateChange(event){
            console.log(event.data)
            if (event.data === YT.PlayerState.PLAYING) {
                isPlaying = true;
                rehabvideoplaheholder.dataset.playstatus = "true";
            } else {
                isPlaying = false;
                rehabvideoplaheholder.dataset.playstatus = "false";
            }
          }
          function togglePlayPause() {
            if (videPlayer) {
                if (isPlaying) {
                  videPlayer.pauseVideo();
                } else {
                  videPlayer.playVideo();
                }
            }
        }
          rehabvideoplaheholder.addEventListener('click', function(e){
            togglePlayPause()
            if (!this.classList.contains('played')) {
                this.classList.add('played')
               
                console.log(isPlaying);
            } else {
                this.classList.remove('played')
              
                console.log(isPlaying);
    
            }
            console.log(this);
          })
        })
    }
     
      console.log(modalClose);
      modalClose.addEventListener('click', function(e){
          fadeOut(modalGalleryContainer);
      })
      rehab_lightboxs.forEach(rehab_lightbox => {
        rehab_lightbox.addEventListener('click', function(e){
            const image = rehab_lightbox.dataset.image;
            modalImage.src = image;
            fadeIn(modalGalleryContainer, 'flex');
        })
      })

}
if (document.querySelectorAll('.insurance-container')) {
    document.querySelectorAll('.insurance-container').forEach(insuranceContainer => {
      const button = insuranceContainer.querySelector('.view-all-insurances-btn');
      const insurancesList = insuranceContainer.querySelector('.insurances-list');
      const insurancesLimit = insurancesList.dataset.limit_item;
      const insuranceItems = insurancesList.querySelectorAll('.insurance-item'); 
      if(button){
        button.addEventListener('click', function(e){
           if (!this.classList.contains('active')) {
              insuranceItems.forEach(insuranceItem => {
                if (insuranceItem.classList.contains('hidden')) {
                  insuranceItem.classList.remove('hidden')
                  fadeIn(insuranceItem);
                }
              })
              this.innerText = this.dataset.open;
              this.classList.add('active');
           }else{
              this.innerText = this.dataset.close;
              this.classList.remove('active');
              let count = 0;
              insuranceItems.forEach(insuranceItem => {
                count++;
                if(count > insurancesLimit){
                  insuranceItem.classList.add('hidden')
                 fadeOut(insuranceItem)
                }
               
              })
           }
  
        })
      } 
    })
}
})
