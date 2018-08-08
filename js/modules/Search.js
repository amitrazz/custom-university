import $ from 'jquery';

class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.addSearchHtml();
    this.resultsDiv = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchFiled =  $("#search-term");
    this.events();
    this.isOverlayOpen == false;
    this.isSpinnerVissiable = false;
    this.priviousValue;
    this.typingTimer;
  }

  // 2. events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    $(document).on("keydown",this.keyPressDispatcher.bind(this));
    this.searchFiled.on("keyup",this.typingLogic.bind(this));
  }

  typingLogic(){
    if(this.priviousValue != this.searchFiled.val()){
      clearTimeout(this.typingTimer);
      if(this.searchFiled.val()){
        if(!this.isSpinnerVissiable){
          this.resultsDiv.html('<div class="spinner-loader"></div>'); 
          this.isSpinnerVissiable = true;     
     }
     this.typingTimer = setTimeout(this.getResults.bind(this) ,400);

      }else{
        this.resultsDiv.html('');
        this.isSpinnerVissiable = false;
      }
    }

    this.priviousValue = this.searchFiled.val();
  }
  getResults(){
    $.getJSON(universityData.root_url +'/wp-json/university/v1/search?term='+ this.searchFiled.val(),(results) => {
      this.resultsDiv.html(`
      <div class="row">
        <div class="one-third">
          <h2 class="search-overlay__section-title">Genral information</h2>
          ${results.genral_info.length ? '<ul class="link-list min-list">' : "<p>nothing matches.</p>"}
          ${results.genral_info.map(item => `<li><a href="${item.permalink}">${item.title} </a>${item.post_type == 'post' ? `By ${item.author} `: ''}</li>`).join('')}   
          ${results.genral_info.length ? '</ul>' : ''}
        </div>
        <div class="one-third">
     <h2 class="search-overlay__section-title">Program</h2>
          ${results.program.length ? '<ul class="link-list min-list">' : `<p>no program match that search <a href='${universityData.root_url}/program'>view all programs</a></p>`}
          ${results.program.map(item => `<li><a href="${item.permalink}">${item.title} </a></li>`).join('')}   
          ${results.program.length ? '</ul>' : ''}
          <h2 class="search-overlay__section-title">Professor</h2>
          ${results.professor.length ? '<ul class="professor-card">' : `<p>no professor match that search</p>`}
          ${results.professor.map(item => `
          <li class="professor-card__list-item">
            <a class="professor-card" href=${item.permalink}>
              <img class="professor-card__img" src="${item.image}" />
              <span class="professor-card__name">${item.title}</span>
            </a>
          </li>
          
          `).join('')}   
          ${results.professor.length ? '</ul>' : ''}
                  
        </div>
        <div class="one-third">
          <h2 class="search-overlay__section-title">Events</h2>
          ${results.event.length ? '' : `<p>no event match that search <a href='${universityData.root_url}/event'>view all events</a></p>`}
          ${results.event.map(item => `
         <div class="event-summary">
          <a class="event-summary__date t-center" href="#">
            <span class="event-summary__month">${item.month}</span>
            <span class="event-summary__day">${item.day}</span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
          <p>${item.discription}<a href="${item.permalink}" class="nu gray">Learn more</a></p>
          </div>
        </div>
          `).join('')}             
        </div>

      </div>
      
      `);
      this.isSpinnerVissiable = false;
    });
  }


  keyPressDispatcher(e){
    if(e.keyCode == 83 && !this.isOverlayOpen && !$("input,textarea").is(":focus")){
      this.openOverlay();
    }
    if(e.keyCode == 27 && this.isOverlayOpen){
      this.closeOverlay();
    }
  }

  // 3. methods (function, action...)
  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.searchFiled.val('');
    setTimeout(() => this.searchFiled.focus(),310)
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    this.isOverlayOpen = false;
  }
  addSearchHtml(){
    $("body").append(`
    <div class="search-overlay">
    <div class="search-overlay__top">
      <div class="container">
        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
        <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
        <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
      </div>
    </div>
    <div class="container">
      <div id="search-overlay__results"></div>
    </div>
  </div>
    `);

  }
  
}

export default Search;