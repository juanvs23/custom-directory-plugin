const ajaxSeekers = document.querySelectorAll('.addic_ajax_filter');

const filterlist = document.querySelectorAll('.filter-list');
const loadMoreRehab = document.querySelector('.load-more-rehab');
const rehabList = document.querySelector('.rehabs-list-wraper .rehab-list');
const termsLists = document.querySelectorAll('.terms-lists');
const faqList = document.querySelectorAll('.faq-list');
const filterListItems = document.querySelectorAll('.filter-list-items .filter-container');
const condition_list = document.querySelectorAll('.condition_list');
const locationCarouselWrappers = document.querySelectorAll('.location-carousel-wrapper');
const addicPostcarouselWrappers = document.querySelectorAll('.addic-postcarousel-wrapper');
const addichottopicitemswrappers = document.querySelectorAll('.addic-hot-topic-items-wrapper');
const addic_filter_tabs = document.querySelectorAll('.addic_filter_tabs');
const articlerehabcards = document.querySelectorAll('.ads-slider article.rehab-card');
const adscarouselrehabcards = document.querySelectorAll('.ads-carousel article.rehab-card');
const buttonReadMoreTabfilterLists = document.querySelectorAll('.read-more-tabfilter-list');
const cliniccarousellist = document.querySelectorAll('.clinic-carousel-list article.rehab-card');
const locationcarousel = document.querySelectorAll('.location-carousel');
const blockCustomContainers = document.querySelectorAll('.content-block-ama-right');

const acordeonsSeo = document.querySelectorAll('.acordeon-seo');


let isDown = false;
let startX;
let scrollLeft;
let slider;


function fadeOut(el) {
    el.style.opacity = 1;
    (function fade() {
        if ((el.style.opacity -= .1) < 0) {
            el.style.display = "none";
        } else {
            requestAnimationFrame(fade);
        }
    })();
};


function moveToTop(element) {
    const checkers = element.querySelectorAll('.filter-checkbox');
    // si el checkbox esta checked
    // creo un htmlCollection vacío
    const elementContainer = element.querySelector('.filter-items');
    
     
    checkers.forEach(checker => {
        if (checker.checked) {
            // guadar este elemento en un array 
            const parent = checker.parentNode.parentNode;            
            // coloca el item de primero en el elemento padre
            elementContainer.insertBefore(parent, elementContainer.firstChild);
        }
    })
    
}



// ** FADE IN FUNCTION **
function fadeIn(el, display) {
    el.style.opacity = 0;
    el.style.display = display || "block";
    (function fade() {
        var val = parseFloat(el.style.opacity);
        if (!((val += .1) > 1)) {
            el.style.opacity = val;
            requestAnimationFrame(fade);
        }
    })();
};

function dragStart(e, slider){
    isDown = true;
    slider.classList.add('dragging');
    startX =  e.pageX || e.touches[0].pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
    //console.log(startX ,'startX');
}
function dragEnd(e, slider){
    isDown = false;
    slider.classList.remove('dragging');
}
function dragMove(e, slider){
    if(!isDown) return;

    e.preventDefault();
    const x = e.pageX || e.touches[0].pageX - slider.offsetLeft;
    const dist = (x - startX);
    slider.scrollLeft = scrollLeft - dist;
}

document.addEventListener('DOMContentLoaded', function () {
    const excluders = document.querySelectorAll('.excluder');
    if(buttonReadMoreTabfilterLists){
        buttonReadMoreTabfilterLists.forEach(buttonReadMoreTabfilterList=>{
            buttonReadMoreTabfilterList.addEventListener('click',function(e){
                this.parentNode.classList.toggle('viewmored');
                this.querySelector('span.tabfilter-text').innerText ==  this.dataset.close? this.querySelector('span.tabfilter-text').innerText = this.dataset.open : this.querySelector('span.tabfilter-text').innerText = this.dataset.close;
            })
        })
    }
    if(acordeonsSeo){
        acordeonsSeo.forEach(acordeonSeoItem => {
            const acordeonSeoItems = acordeonSeoItem.querySelectorAll('.acordeon-item');
            acordeonSeoItems.forEach((acordeonSeoItem, i)=>{
                const acordeonButton = acordeonSeoItem.querySelector('.acordeon-item-button');
                const acordeonContent = acordeonSeoItem.querySelector('.acordeon-item-content');
                const acordeonContentHeight = acordeonSeoItem.querySelector('.text').clientHeight;

                acordeonButton.addEventListener('click',function(e){
                    acordeonSeoItems.forEach((acordeonSeoItem, i)=>{
                        acordeonSeoItem.classList.remove('open');
                        acordeonSeoItem.setAttribute('aria-expanded', false);
                        acordeonSeoItem.querySelector('.acordeon-item-content').style.height = '0px';  
                    })

                    acordeonSeoItem.classList.add('open');
                    acordeonSeoItem.setAttribute('aria-expanded', true);
                    acordeonSeoItem.querySelector('.acordeon-item-content').style.height = acordeonContentHeight + 'px';
                   
                });
            })
        })
    }
    if(blockCustomContainers){
        blockCustomContainers.forEach(blockCustomContainer => {
            const readmore = blockCustomContainer.querySelector('.btn-content-block-ama');
            const blockCustomContent = blockCustomContainer.querySelector('.content-block-ama-content');
            const blockCustomContentWrapperHeight = blockCustomContainer.querySelector('.content-block-wrapper').clientHeight;
            //console.log(blockCustomContentWrapperHeight);
            if(blockCustomContentWrapperHeight<169){
                readmore.style.display = 'none';
            }
            readmore.addEventListener('click', function(e){
                if(!blockCustomContainer.classList.contains('actived')){
                    blockCustomContainer.classList.add('actived');
                    this.querySelector('span').innerText = this.dataset.open;
                    blockCustomContent.style.height = blockCustomContentWrapperHeight + 'px';
                    
                }else{
                    blockCustomContainer.classList.remove('actived');
                    this.querySelector('span').innerText = this.dataset.close;
                    blockCustomContent.style.height = 170 + 'px';
                }

            })
        })
    }
   
   
    
    if(excluders){
        excluders.forEach(function(excluder, i){

            //console.log(excluder);
            const inputs = excluder.querySelectorAll('.filter-item .filter-checkbox');
            inputs.forEach(async function (input,index){
                input.addEventListener('click',async function(e){
                    inputs.forEach(input=>{input.checked = false});
                    input.checked = true;
                })
            })
        });
    }
    if(addic_filter_tabs){
        addic_filter_tabs.forEach(addic_filter_tab=>{
            const triggers = addic_filter_tab.querySelectorAll('.addic_filter_tab_title');
            const contents = addic_filter_tab.querySelectorAll('.addic_filter_tab_content');

            triggers.forEach((trigger,i)=>{
                trigger.addEventListener('click',function(e){
                    if(!trigger.classList.contains('active')){
                        triggers.forEach(trigger=>{trigger.classList.remove('active')});
                        contents.forEach(content=>{content.classList.remove('opened')});

                        trigger.classList.add('active');
                        contents[i].classList.add('opened');
                    }

                });
            })
        })
    }
    if(condition_list){
        condition_list.forEach((condition, i)=> {
            const loadMoreCondition = condition.querySelector('button.condition-load-more');

           if(loadMoreCondition){
            loadMoreCondition.addEventListener('click',function(e){
                const condition_hides = condition.querySelector('.condition_hides');
                
                    if (!this.classList.contains('active-rotate')) {
                        this.classList.add('active-rotate');
                        condition_hides.classList.toggle('extras');
                        
                    }else{
                        this.classList.remove('active-rotate');
                        condition_hides.classList.toggle('extras');
                    }
                

            })
           }
        })
    }

    if(addichottopicitemswrappers){
        addichottopicitemswrappers.forEach(addichottopicitemswrapper=>{
            const addichottopicitems = addichottopicitemswrapper.querySelector('.addic-hot-topic-items')
            const addichottopicitemsSwiper = new Swiper(addichottopicitems,{
                slidesPerView: 'auto',
                spaceBetween: 15,
                speed: 1000,

                navigation:{
                    nextEl: `#${addichottopicitemswrapper.id} .hot-topic-next`,
                    prevEl: `#${addichottopicitemswrapper.id} .hot-topic-prev`,
                },
                /* breakpoints:{
                    767: {
                        slidesPerView: 2,
                        
                    },
                    1025: {
                        slidesPerView: 3,
  
                    },
                } */
            })
        })
    }
    if(addicPostcarouselWrappers){
        addicPostcarouselWrappers.forEach((addicPostcarouselWrapper, i)=> {
            const addicPostcarousel = addicPostcarouselWrapper.querySelector('.addic-postcarousel');

            const addicPostSwiper = new Swiper(addicPostcarousel, {
                slidesPerView: 1,
                spaceBetween: 15,
                loop: true,
                // autoplay: {
                //     delay: 2500,
                //     disableOnInteraction: false
                // },
                speed: 1000,

                navigation:{
                    nextEl: '.addic-post-next',
                    prevEl: '.addic-post-prev',
                },
                pagination: {
                    el: '.addic-post-pagination',
                    clickable: true,
                },
                breakpoints:{
                    767: {
                        slidesPerView: 2,
                        
                    },
                    1025: {
                        slidesPerView: 3,
  
                    },
                }
            })
        })
    }
    if(locationCarouselWrappers){
        locationCarouselWrappers.forEach((locationCarouselWrapper, i)=> {
            const locationCarousel = locationCarouselWrapper.querySelector('.location-carousel');
            
            const desktop = locationCarousel.dataset.desktop;
            const tablet = locationCarousel.dataset.tablet;
            const mobile = locationCarousel.dataset.mobile;
         //   //console.log(parseInt(tablet));

            const locationSwiper = new Swiper(locationCarousel, {
                slidesPerView: parseInt(mobile),
              
                spaceBetween: 10,
                navigation:{
                    nextEl: '.location-next',
                    prevEl: '.location-prev',
                },
                pagination: {
                    el: '.location-pagination',
                    clickable: true,
                },
                breakpoints: {
                    767: {
                        slidesPerView: parseInt(tablet),
                      
                        spaceBetween: 15,
                    },
                  
                    1025: {
                        slidesPerView: parseInt(desktop),
                        spaceBetween: 25,
                      
                    },
                    on: {
                        init() {
                            //console.log('swiper initialized');
                           
                        },
                      }
                   

                },
            })
            locationSwiper.on('afterInit', function () {
                //console.log('object');
            })
            if(locationcarousel){
                locationcarousel.forEach(locationcarousel => {
                    const locationcards = locationcarousel.querySelectorAll('.location-card a.location__link');
                    let minHeight = 0;
                    locationcards.forEach(locationcard => {
        
                        const elementHeight = locationcard.clientHeight;
                        if(elementHeight > minHeight){
                            minHeight = elementHeight
                        }
                        //console.log(minHeight,'minHeight');
                    })
                    locationcards.forEach(locationcard => {
                        locationcard.style.height = `${minHeight}px`;
                    })
                })
            }
        })
    }
    if(filterListItems){
        const filterCounters = document.querySelectorAll('span.counter-title');
        filterListItems.forEach((filterList, i)=> {
          
            const terms = filterList.querySelectorAll('.filter-item .filter-checkbox');
            terms.forEach(function (term){
                term.addEventListener('change',async function(e){
                    let filters = [];
                    filterListItems.forEach((filterList, i)=> {
                        const inputs = filterList.querySelectorAll('.filter-item .filter-checkbox');
                        moveToTop(filterList);
                        inputs.forEach(async function (input,index){
                            if (input.checked === true) {
                                const filterTaxonomy = input.dataset.taxonomy;
                                const inputValue = input.value;
                                //console.log(filterTaxonomy);
                                filters.push({
                                    'taxonomy': filterTaxonomy,
                                    'inputValue': inputValue
                                });
                            }                            
                        })
                    })
                    
                    loadMoreRehab.dataset.offset = 0;
                    loadMoreRehab.dataset.tax_filter = JSON.stringify(filters);
                    
                    //console.log( JSON.stringify(filters) );

                    
                       // document.querySelector('.rehab-list').innerHTML = '';
                        
                        const action = 'get_rehabs_post';
                        const url = addic_clinic_ajax.ajax_url;
                        const nonce = addic_clinic_ajax.nonce;
                        const formdata = new FormData();
                        formdata.append('action', action);
                        formdata.append('filters', JSON.stringify(filters));
                        formdata.append('offset', loadMoreRehab.dataset.offset);
                        formdata.append('limit', loadMoreRehab.dataset.addcards);
                        formdata.append('nonce', nonce);
                        const response = await fetch(url, {
                            method: 'POST',
                          
                            body: formdata
                        })
    
                        const responseJson = await response.json();
                        //console.log(responseJson, 'responseJson');
                        filterCounters.forEach(counter => {
                            counter.innerHTML = responseJson.data.total;
                        })
                        //console.log(responseJson.data.total,'responseJson.data.total');
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(responseJson.data.response, 'text/html');
                        const nodos = doc.body;
                        document.querySelector('.rehab-list').innerHTML = '';

                        document.querySelector('.rehab-no-list').innerHTML = '';
                        
                        Array.from(nodos.children).forEach(nodo => {
                            const importedNode = document.importNode(nodo, true);
                            if(responseJson.data.total == 0){
                                document.querySelector('.rehab-no-list').appendChild(importedNode);
                            }else{
                                document.querySelector('.rehab-list').appendChild(importedNode);
                            }
                           /// filterTaxonomy.appendChild(importedNode);
                        })
                        setTimeout(() => {
                            loadMoreRehab.dataset.offset = responseJson.data.offset;
                            loadMoreRehab.dataset.term = '';
                            loadMoreRehab.dataset.tax = '';
                            document.querySelectorAll('.rehab-hidden').forEach(rehab => {
                                rehab.classList.remove('rehab-hidden');
                            })
                          
                        },300)
                        if( responseJson.data.endpage == true){
                            fadeOut(document.querySelector('.load-more-rehab'));
                         }else{
                            fadeIn(document.querySelector('.load-more-rehab'));
                         }
                    
                })
            })
        })
        filterListItems.forEach((filterListItem,i)=>{
            moveToTop(filterListItem)
        })
    }
   


    if(loadMoreRehab){
        loadMoreRehab.addEventListener('click',async function(e){
             const limit = loadMoreRehab.dataset.addcards;
             const offset = loadMoreRehab.dataset.offset;
             const action = 'coltman_load_more_posts';
             const tax = loadMoreRehab.dataset.tax;
             const term = loadMoreRehab.dataset.term;
             const tax_filter = loadMoreRehab.dataset.tax_filter;
             const formdata = new FormData();
             const url = addic_clinic_ajax.ajax_url;
             const nonce = addic_clinic_ajax.nonce;
             formdata.append('action', action);
             formdata.append('limit', parseInt(limit) + parseInt(offset));
             formdata.append('offset', parseInt(offset));
             formdata.append('nonce', nonce);
             formdata.append('tax', tax);
             formdata.append('term', term);
             formdata.append('tax_filter', tax_filter);
             //console.log(parseInt(limit) + parseInt(offset));
             const loader = document.createElement('div');

             //<div class="loader"></div>
             loader.setAttribute('class','loader');
             loadMoreRehab.parentNode.appendChild(loader);

             //console.log(addic_clinic_ajax);
             const rehabListresponse = await fetch(url, {
                method: 'POST',
                body: formdata,
            })
            const parser = new DOMParser();
             const rehabListJson = await rehabListresponse.json();
             const doc = parser.parseFromString(rehabListJson.data.response, 'text/html');
             const nodos = doc.body;

             //console.log(Array.from(nodos.children).length,'new nodos');
             //console.log(document.querySelector('.rehab-list').children.length,'old nodos');
             Array.from(nodos.children).forEach(nodo => {
             //   //console.log(nodo.children);
                 const importedNode = document.importNode(nodo, true);
                 rehabList.appendChild(importedNode);

             })
             //console.log(document.querySelector('.rehab-list').children.length,'new nodos');
             
             //console.log(rehabListJson);
                this.dataset.offset = parseInt(rehabListJson.data.offset);
                this.dataset.offset = Array.from(rehabList.children).length;
             setTimeout(() => {
                loadMoreRehab.parentNode.querySelector('.loader').remove();
                 document.querySelectorAll('.rehab-hidden').forEach(rehab => {
                     rehab.classList.remove('rehab-hidden');
                 })
               
             },300)
             if(rehabListJson.data.endpage == true){
                fadeOut(this)
             }else{
                fadeIn(this)
             }
        })
    }

    if(filterlist){
       // //console.log(filterlist);
       const windowWidth = window.innerWidth;
       //console.log(windowWidth);
        filterlist.forEach(filter => {
            const filtertrigger = filter.querySelector('.filter-trigger');
            const filterWrappper = filter.querySelector('.filter-wrappper');
            const readmoreFilterButtons = filter.querySelectorAll('.readmore-filter-button');
    
            filtertrigger.addEventListener('click', function(e){
                filterWrappper.parentNode.classList.toggle('active');
            })

            readmoreFilterButtons.forEach(readmoreFilterButton => {

                readmoreFilterButton.addEventListener('click', function(e){
                    readmoreFilterButton.parentNode.classList.toggle('openmore');
                    this.querySelector('span').innerText ==  this.dataset.close? this.querySelector('span').innerText = this.dataset.open : this.querySelector('span').innerText = this.dataset.close; 
                })
            })

    
        })
        if(windowWidth>767){
            filterlist.forEach(filter => {
                filter.classList.add('active');
                
            })
        }

    }
    if (document.querySelectorAll('.ads-carousel .rehab-card-gallery')) {
        const swiperNested = new Swiper('.ads-carousel .rehab-card-gallery', {
            slidesPerView: 1,
            speed: 500,
            spaceBetween: 10,
            loop:true,
          
            freeMode: true,
            lazy: true,
            pagination: {
                el: ".rehab-card-gallery-pagination",
                clickable: true,
              },
        })
    }
    if (document.querySelectorAll('.rehab-list .rehab-card-gallery')) {
        const swiperNested = new Swiper('.rehab-list .rehab-card-gallery', {
            slidesPerView: 1,
            speed: 500,
            spaceBetween: 10,
          
            freeMode: true,
            lazy: true,
            pagination: {
                el: ".rehab-card-gallery-pagination",
                clickable: true,
              },
        })
    }
    if(document.querySelectorAll('.ads-slider .rehab-card-gallery')){
        const swiperNested = new Swiper('.ads-slider .rehab-card-gallery', {
            slidesPerView: 1,
            speed: 500,
            spaceBetween: 10,
          
            freeMode: true,
            lazy: true,
            pagination: {
                el: ".rehab-card-gallery-pagination",
                clickable: true,
              },
              breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
                1280: {
                    slidesPerView: 4,
                },
              }
        })
    }
    if(document.querySelectorAll('.ads-slider')){
        const adsSlider = new Swiper('.ads-slider', {
            slidesPerView: 1,
            speed: 2500,
            spaceBetween: 10,
            loop: true,
			 freeMode: true,
            centerInsufficientSlides: true,
            createElements: true,
            autoplay: {
                delay: 5000,
            },
          //  virtual: true,
     
            // freeMode: true,
          //   lazy: true,
             pagination: {
                 el: ".ads-carousel-pagination",
                 clickable: true,
            },
        })
    }
    if (document.querySelectorAll('.ads-carousel')) {

        const adscarousel = new Swiper('.ads-carousel', {
            slidesPerView: 1,
      
            speed: 500,
            spaceBetween: 10,
           // lazy: true,
            loop: true,
           freeMode: true,
            centerInsufficientSlides: true,
            createElements: true,
            pagination: {
                el: ".ads-carousel-pagination",
                clickable: true,
              },
              navigation:{
                nextEl: '.ads-carousel-next',
                prevEl: '.ads-carousel-prev',
              },
              breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
              }
        })
        
    }
    if(document.querySelectorAll('.clinic-swiper')){
        const clinicSwiper = new Swiper('.clinic-swiper', {
            slidesPerView: 1,

            speed: 500,
            loop: true,
            spaceBetween: 10,
            lazy: true,
            freeMode: true,
            pagination: {
                el: ".clinic-swiper .ads-carousel-pagination",
                clickable: true,
              },
               navigation:{
                nextEl: '.clicnic-carousel-next',
                prevEl: '.clicnic-carousel-prev',
              },
              breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
              }
        })
    }
    if(faqList){
        faqList.forEach(faq => {
            const faqItems = faq.querySelectorAll('.faq-item');
            faqItems.forEach(faqItem => {
                const trigger = faqItem.querySelector('.faq-item-title');
                trigger.addEventListener('click', function(e){
                    faqItems.forEach(faqItem => {
                        faqItem.classList.remove('open');
                    })
                    this.parentNode.classList.add('open');
                })
            })
        })
    }
    if (document.querySelectorAll('.staff-member-list')) {
        const staffSwiper = new Swiper('.staff-member-list', {
            slidesPerView: 1,
          
            loop: true,
            speed: 500,
            lazy: true,
            autoplay: {
                delay: 2500,
            },
            pagination: {
                el: ".staff-member-pagination",
                clickable: true,
            },
            freeMode: true,
            breakpoints: {
                768: {
                    slidesPerView: 2,

                },
                1024: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                }
            }
        })
    }
    
    if(document.querySelectorAll('.tablist')){
        document.querySelectorAll('.tablist').forEach(tablist => {
            
            const tablistItems = tablist.querySelectorAll('.tab-item');
            const tabNavs = tablist.querySelectorAll('li.tab-nav h3');
            const tabItemHeaders = tablist.querySelectorAll('.tab-item-header h3');

            tabItemHeaders.forEach(tabItemHeader => {

                tabItemHeader.addEventListener('click', function(e){
                    tabItemHeaders.forEach(tab => {
                        tab.classList.remove('active-nav');
                    })
                    this.classList.add('active-nav');
                    tablistItems.forEach(tablistItem => {
                        tablistItem.classList.remove('open-tab');
                    })
                    this.parentNode.parentNode.classList.add('open-tab');
                })
            })

            tabNavs.forEach(tabNav => {
                tabNav.addEventListener('click', function(e){
                    tabNavs.forEach(tab => {
                        tab.classList.remove('active-nav');
                    })
                    this.classList.add('active-nav');
                    
                    tablistItems.forEach(tablistItem => {
                        tablistItem.classList.remove('open-tab');
                       // //console.log(this.dataset.target);
                        if(tablistItem.getAttribute('id') == this.dataset.target){
                            tablistItem.classList.add('open-tab');
                        }
                    })
                })
            })

          
        })
    }
    setTimeout(() => {

        if(addicPostcarouselWrappers){
            const addicPostCard = document.querySelectorAll('.addic-postcarousel-wrapper .addic-post-card');
            let minHeight = 0;
            addicPostCard.forEach(addicPostCard => {
    
                const elementHeight = addicPostCard.clientHeight;
                if(elementHeight > minHeight){
                    minHeight = elementHeight
                }
               // //console.log(minHeight,'minHeight');
            });
            addicPostCard.forEach(addicPostCard => {
                addicPostCard.style.minHeight = `${minHeight}px`;
            });
        }

        if(adscarouselrehabcards){
            let minHeight = 0;
            adscarouselrehabcards.forEach(adscarouselrehabcard => {
    
                const elementHeight = adscarouselrehabcard.clientHeight;
                if(elementHeight > minHeight){
                    minHeight = elementHeight
                }
               // //console.log(minHeight,'minHeight');
            });
            adscarouselrehabcards.forEach(adscarouselrehabcard => {
                adscarouselrehabcard.style.minHeight = `${minHeight}px`;
            });
    
        }
        if(articlerehabcards){
            let minHeight = 0;
            articlerehabcards.forEach(articlerehabcard => {
    
                const elementHeight = articlerehabcard.clientHeight;
                if(elementHeight > minHeight){
                    minHeight = elementHeight
                }
               // //console.log(minHeight,'minHeight');
    
            })
            articlerehabcards.forEach(articlerehabcard => {
                articlerehabcard.style.minHeight = `${minHeight}px`;
            })
        }
        if(cliniccarousellist){
            let minHeight = 0;
            cliniccarousellist.forEach(cliniccarousellist => {
    
                const elementHeight = cliniccarousellist.clientHeight;
                if(elementHeight > minHeight){
                    minHeight = elementHeight
                }
                ////console.log(minHeight,'minHeight');
            });
            cliniccarousellist.forEach(cliniccarousellist => {
                cliniccarousellist.style.minHeight = `${minHeight}px`;
            });
        }
    },1500)
})
if(ajaxSeekers){
    ajaxSeekers.forEach(ajaxSeeker => {
        const ajaxForm = ajaxSeeker.querySelector('form');
        const ajaxInput = ajaxSeeker.querySelector('input[type="text"]');
        const result = ajaxSeeker.querySelector('.addic_ajax_result .addic_ajax_content');
        const addic_ajax_formLoader = ajaxSeeker.querySelector('.addic_ajax_form .loader');
        const ajaxAction = ajaxSeeker.querySelector('input[name="action"]');
        const ajaxNonce = ajaxSeeker.querySelector('input[name="nonce"]');
        const url = addic_clinic_ajax.ajax_url;
        let abortController;
        ajaxForm.addEventListener('submit', function(e){
            e.preventDefault();
        });
        ajaxInput.addEventListener('keyup',async function(e){
            abortController = new AbortController();
            const signal = abortController.signal;


            
            if(e.target.value.length > 2){
                addic_ajax_formLoader.classList.add('active');
                const formData = new FormData();
                formData.append('action', ajaxAction.value);
                formData.append('nonce', ajaxNonce.value);
                formData.append('search', e.target.value)
                try{
                    const response = await fetch(url,{
                        method: 'POST',
                        body: formData,
                        signal: signal,
                        
                    })
                    const resultData = await response.json();
                    setTimeout(() => {
                        addic_ajax_formLoader.classList.remove('active');
                    },300)

                    //console.log(resultData);
                    result.innerHTML = resultData.data;
                    result.parentNode.classList.add('active');
                  //  result.innerHTML = ;
                }catch(error){

                }
            }else{
                result.parentNode.classList.remove('active');
            }
        })

    })
}

if(termsLists){
    termsLists.forEach(termsList => {
        const termsListItems = termsList.querySelectorAll('.terms-lists-item');
        const viewMoreTrigger = termsList.querySelector('.view-more-trigger');
            if ( viewMoreTrigger){ 
              //  //console.log(termsList);
                viewMoreTrigger.addEventListener('click', function(e){
                    const limit = this.dataset.limit;
                    termsListItems.forEach((termsListItem, index )=> {
                        if(termsListItem.classList.contains('hidden')){
                            
                            fadeIn(termsListItem);
                            termsListItem.classList.remove('hidden');
                        }else{
                            if(index >= limit){
                                fadeOut(termsListItem);
                                termsListItem.classList.add('hidden');
                            }
                        }
                    })
                   // fadeOut(viewMoreTrigger);
                   this.innerHTML != this.dataset.open? this.innerHTML = this.dataset.open : this.innerHTML = this.dataset.close;
                })
            }
        })
  
}