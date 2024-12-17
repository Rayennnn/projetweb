(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() { 
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        dots: true,
        loop: true,
        items: 1
    });
    
})(jQuery);

/**CODE RAYEN */
let products = {
    data: [
      {
        productName: "Regular White T-Shirt",
        category: "Topwear",
        price: "30",
        image: "bourse1.jpg",
      },
      {
        productName: "Beige Short Skirt",
        category: "Bottomwear",
        price: "49",
        image: "bourse1.jpg",
      },
      {
        productName: "Sporty SmartWatch",
        category: "Watch",
        price: "99",
        image: "bourse1.jpg",
      },
      {
        productName: "Basic Knitted Top",
        category: "Topwear",
        price: "29",
        image: "bourse2.jpg",
      },
      {
        productName: "Black Leather Jacket",
        category: "Jacket",
        price: "129",
        image: "bourse1.jpg",
      },
      {
        productName: "Stylish Pink Trousers",
        category: "Bottomwear",
        price: "89",
        image: "bourse1.jpg",
      },
      {
        productName: "Brown Men's Jacket",
        category: "Jacket",
        price: "189",
        image: "bourse1.jpg",
      },
      {
        productName: "Comfy Gray Pants",
        category: "Bottomwear",
        price: "49",
        image: "bourse1.jpg",
      },
    ],
  };
  
  for (let i of products.data) {
    //Create Card
    let card = document.createElement("div");
    //Card should have category and should stay hidden initially
    card.classList.add("card", i.category, "hide");
    //image div
    let imgContainer = document.createElement("div");
    imgContainer.classList.add("image-container");
    //img tag
    let image = document.createElement("img");
    image.setAttribute("src", i.image);
    imgContainer.appendChild(image);
    card.appendChild(imgContainer);
    //container
    let container = document.createElement("div");
    container.classList.add("container");
    //product name
    let name = document.createElement("h5");
    name.classList.add("product-name");
    name.innerText = i.productName.toUpperCase();
    container.appendChild(name);
    //price
    let price = document.createElement("h6");
    price.innerText = "$" + i.price;
    container.appendChild(price);
  
    card.appendChild(container);
    document.getElementById("products").appendChild(card);
  }
  
  //parameter passed from button (Parameter same as category)
  function filterProduct(value) {
    //Button class code
    let buttons = document.querySelectorAll(".button-value");
    buttons.forEach((button) => {
      //check if value equals innerText
      if (value.toUpperCase() == button.innerText.toUpperCase()) {
        button.classList.add("active");
      } else {
        button.classList.remove("active");
      }
    });
  
    //select all cards
    let elements = document.querySelectorAll(".card");
    //loop through all cards
    elements.forEach((element) => {
      //display all cards on 'all' button click
      if (value == "all") {
        element.classList.remove("hide");
      } else {
        //Check if element contains category class
        if (element.classList.contains(value)) {
          //display element based on category
          element.classList.remove("hide");
        } else {
          //hide other elements
          element.classList.add("hide");
        }
      }
    });
  }
  
  //Search button click
  document.getElementById("search").addEventListener("click", () => {
    //initializations
    let searchInput = document.getElementById("search-input").value;
    let elements = document.querySelectorAll(".product-name");
    let cards = document.querySelectorAll(".card");
  
    //loop through all elements
    elements.forEach((element, index) => {
      //check if text includes the search value
      if (element.innerText.includes(searchInput.toUpperCase())) {
        //display matching card
        cards[index].classList.remove("hide");
      } else {
        //hide others
        cards[index].classList.add("hide");
      }
    });
  });
  
  //Initially display all products
  window.onload = () => {
    filterProduct("all");
  };
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const typeFilter = document.getElementById('typeFilter');
    const countryFilter = document.getElementById('countryFilter');
    const levelFilter = document.getElementById('levelFilter');
    const durationFilter = document.getElementById('durationFilter');

    const exchangeItems = document.querySelectorAll('.exchange-item');
    const courseCards = document.querySelectorAll('.course-card');

    let currentSlide = 0;
    const slides = document.querySelectorAll('.courses-slide');
    const dots = document.querySelectorAll('.dot');

    function filterItems() {
      const searchTerm = searchInput.value.toLowerCase();
      const selectedType = typeFilter.value;
      const selectedCountry = countryFilter.value;
      const selectedLevel = levelFilter.value;
      const selectedDuration = durationFilter.value;

      exchangeItems.forEach(item => {
        const title = item.querySelector('h3').textContent.toLowerCase();
        const details = item.querySelector('.exchange-details').textContent.toLowerCase();
        
        let showItem = true;

        if (searchTerm && !title.includes(searchTerm) && !details.includes(searchTerm)) {
          showItem = false;
        }

        if (selectedType !== 'all' && selectedType === 'scholarship') {
          showItem = false;
        }

        item.style.display = showItem ? 'block' : 'none';
      });
    }

    function moveSlide(direction) {
      currentSlide = (currentSlide + direction + slides.length) % slides.length;
      updateSlider();
    }

    function goToSlide(slideIndex) {
      currentSlide = slideIndex;
      updateSlider();
    }

    function updateSlider() {
      const slider = document.querySelector('.courses-slider');
      if (slider) {
        slider.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        dots.forEach((dot, index) => {
          dot.classList.toggle('active', index === currentSlide);
        });
      }
    }

    searchInput.addEventListener('input', filterItems);
    typeFilter.addEventListener('change', filterItems);
    countryFilter.addEventListener('change', filterItems);
    levelFilter.addEventListener('change', filterItems);
    durationFilter.addEventListener('change', filterItems);

    if (slides.length > 0) {
      setInterval(() => moveSlide(1), 5000);
    }
  });
  