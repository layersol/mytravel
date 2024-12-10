
const searchInputs = document.querySelectorAll('.search-input');

// loop through all input elements
// searchInputs.forEach((input) => {
// const matchList = document.createElement('div');
// matchList.classList.add('search-results', `search-results-${input.id}`);
// input.parentNode.insertBefore(matchList, input.nextElementSibling);

// const searchCities = async (searchText) => {
//   const res = await fetch(baseUrl+"/assets/frontend/js/airports_list.json");
//   const cities = await res.json();
//   let matches = cities.filter((city_air) => {
//   const regex = new RegExp(`^${searchText}`, 'gi');
//   return city_air.name.match(regex) || city_air.country.match(regex) || city_air.iata_code.match(regex) || city_air.city.match(regex);
//   });

//   if (searchText.length === 0) {
//   matches = [];
//   matchList.innerHTML = '';
//   matchList.style.display = 'none';
//   matchList.classList.remove('overflow-Class');
//   } else {
//   outputHtml(matches, matchList,searchText);
//   matchList.style.display = 'block';
//   matchList.classList.add('overflow-Class');
//   }
// }

// input.addEventListener('input', () => {
//   searchCities(input.value);
//   const activeResults = document.querySelector(`.search-results-${input.id}`);
//   document.querySelectorAll('.search-results').forEach(result => {
//   if (result !== activeResults) {
//       result.style.display = 'none';
//       result.classList.remove('overflow-Class');
//   }
//   });
// }); // input event for input box

// const outputHtml = (matches, list, searchText) => {
// if (matches.length > 0) {
//   const html = matches.map((match) => {
//   // create a new regular expression object with global and case-insensitive flags
//   const regex = new RegExp(`(${searchText})`, 'gi');
//   // highlight the matched text using a span element with a special CSS class
//   const highlightedName = match.name.replace(regex, '<span class="highlighted d-inline">$1</span>');
//   const highlightedCountry = match.country.replace(regex, '<span class="highlighted d-inline">$1</span>');
//   const highlightedIata = match.iata_code.replace(regex, '<span class="highlighted d-inline">$1</span>');
//   const highlightedCity = match.city.replace(regex, '<span class="highlighted d-inline">$1</span>');

//   return `
//       <div class="testing_purpose">
//       <h6 onClick="getClickedValues('${match.name} ${match.city}, ${match.country} (${match.iata_code})', '${input.id}')">
//       <i class="fas fa-map-marker-alt"></i>
//           ${highlightedName} ${highlightedCity}, ${highlightedCountry} <span>(${highlightedIata}) </span>
//       </h6>
//       </div>
//   `;
//   }).join('');

//   list.innerHTML = html;
// } else {

//   const html = `
//   <div class="testing_purpose">
//   <h6 >
//       No result found
//   </h6>
//   </div>
// `
// list.innerHTML = html;

//   }
// }


// });


searchInputs.forEach((input) => {
  const matchList = document.createElement('div');
  matchList.classList.add('search-results', `search-results-${input.id}`);
  input.parentNode.insertBefore(matchList, input.nextElementSibling);

  const debounce = (func, delay) => {
      let timeoutId;
      return (...args) => {
          clearTimeout(timeoutId);
          timeoutId = setTimeout(() => {
              func(...args);
          }, delay);
      };
  };

  const searchCities = async (searchText) => {
      const res = await fetch(baseUrl + `/airports/search?searchText=${searchText}`);
      const cities = await res.json();

      // return;
      if (searchText.length === 0) {
          matchList.innerHTML = '';
          matchList.style.display = 'none';
          matchList.classList.remove('overflow-Class');
      } else {
          outputHtml(cities, matchList, searchText, input);
          matchList.style.display = 'block';
          matchList.classList.add('overflow-Class');
      }
  };

  const outputHtml = (matches, list, searchText, input) => {
      if (matches.length > 0) {
          const html = matches.map((match) => {
              const regex = new RegExp(`(${searchText})`, 'gi');
              const highlightedName = match.name.replace(regex, '<span class="highlighted d-inline">$1</span>');
              const highlightedCountry = match.country.replace(regex, '<span class="highlighted d-inline">$1</span>');
              const highlightedIata = match.iata.replace(regex, '<span class="highlighted d-inline">$1</span>');
              const highlightedCity = match.city.replace(regex, '<span class="highlighted d-inline">$1</span>');

              return `
                  <div class="testing_purpose">
                      <h6 onClick="getClickedValues('${match.name} ${match.city}, ${match.country} (${match.iata})', '${input.id}')">
                          <i class="fas fa-map-marker-alt"></i>
                          ${highlightedName} ${highlightedCity}, ${highlightedCountry} <span>(${highlightedIata}) </span>
                      </h6>
                  </div>
              `;
          }).join('');

          list.innerHTML = html;
      } else {
          const html = `
              <div class="testing_purpose">
                  <h6>
                      No result found
                  </h6>
              </div>
          `;
          list.innerHTML = html;
      }
  };

  input.addEventListener('input', debounce(() => {
      const searchText = input.value.trim();
      searchCities(searchText);
      
      const activeResults = document.querySelector(`.search-results-${input.id}`);
      document.querySelectorAll('.search-results').forEach(result => {
          if (result !== activeResults) {
              result.style.display = 'none';
              result.classList.remove('overflow-Class');
          }
      });
  }, 300)); // Adjust debounce delay as needed
});


// function to get values of clicked element 
const getClickedValues = (textData, inputId) => {
const input = document.querySelector(`#${inputId}`);
const airportCode = document.querySelector(`#${inputId}_code`);
input.value = textData;
const iataCode = textData.split('(')[1].replace(')', "");
airportCode.value = iataCode;
const matchList = document.querySelector(`.search-results-${inputId}`);
matchList.innerHTML = '';
matchList.classList.remove('overflow-Class');

// Check if all other inputs in the form have an empty value
const form = input.closest('form');
const otherInputs = form.querySelectorAll('.search-input:not(#' + inputId + ')');

otherInputs.forEach(focusInput => {
      if(focusInput.value.trim()==''){
        focusInput.focus();
        return;
      }
  });



}

