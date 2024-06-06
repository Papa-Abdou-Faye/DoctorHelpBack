/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

import './bootstrap';

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// navbar vertical

const body = document.querySelector('body'),
    sidebar = body.querySelector('.sidebar'),
     toggle = body.querySelector('.toggle'),
 modeSwitch = body.querySelector('.toggle-switch'),
   modetext = body.querySelector('.mode-text'),
themeSwitch = body.querySelector('.toggle-switchtheme'),
themetext = body.querySelector('theme-text'),
top = body.querySelector('.top');

//mode sombre claire
 modeSwitch.addEventListener('click',()=>{
    body.classList.toggle('dark');
 });

 toggle.addEventListener('click', ()=>{sidebar.classList.toggle("fermer")});


  // source code
  let calendar = document.querySelector('.calendar')

  const month_names = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Jun', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre']

  isLeapYear = (year) => {
      return (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) || (year % 100 === 0 && year % 400 ===0)
  }

  getFebDays = (year) => {
      return isLeapYear(year) ? 29 : 28
  }

  generateCalendar = (month, year) => {

      let calendar_days = calendar.querySelector('.calendar-days')
      let calendar_header_year = calendar.querySelector('#year')

      let days_of_month = [31, getFebDays(year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]

      calendar_days.innerHTML = ''

      let currDate = new Date()
      if(month == null) month = currDate.getMonth()
      if (!year) year = currDate.getFullYear()

      let curr_month = `${month_names[month]}`
      month_picker.innerHTML = curr_month
      calendar_header_year.innerHTML = year

      // get first day of month

      let first_day = new Date(year, month, 1)

      for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {
          let day = document.createElement('div')
          if (i >= first_day.getDay()) {
              day.classList.add('calendar-day-hover')
              day.innerHTML = i - first_day.getDay() + 1
              day.innerHTML += `<span></span>
                              <span></span>
                              <span></span>
                              <span></span>`
              if (i - first_day.getDay() + 1 === currDate.getDate() && year === currDate.getFullYear() && month === currDate.getMonth()) {
                  day.classList.add('curr-date')
              }
          }
          calendar_days.appendChild(day).onclick = () =>{
            let mois = month +1 ;
            let jour =  i - first_day.getDay() + 1;
            let dd = year + "-" + mois + "-" + jour;
            document.cookie = "rvDuJour = " + dd;
            window.location.href = '/accAvecCal' ;
        }
      }
  }

  let month_list = calendar.querySelector('.month-list')

  month_names.forEach((e, index) => {
      let month = document.createElement('div')
      month.innerHTML = `<div data-month="${index}">${e}</div>`
      month.querySelector('div').onclick = () => {
          month_list.classList.remove('show')
          curr_month.value = index
          generateCalendar(index, curr_year.value)
      }
      month_list.appendChild(month)
  })

  let month_picker = calendar.querySelector('#month-picker')

  month_picker.onclick = () => {
      month_list.classList.add('show')
  }

  let currDate = new Date()

  let curr_month = {value: currDate.getMonth()}
  let curr_year = {value: currDate.getFullYear()}

  generateCalendar(curr_month.value, curr_year.value)

  document.querySelector('#prev-year').onclick = () => {
      --curr_year.value
      generateCalendar(curr_month.value, curr_year.value)
  }

  document.querySelector('#next-year').onclick = () => {
      ++curr_year.value
      generateCalendar(curr_month.value, curr_year.value)
  }

  let dark_mode_toggle = document.querySelector('.dark-mode-switch')

  dark_mode_toggle.onclick = () => {
      document.querySelector('body').classList.toggle('light')
      document.querySelector('body').classList.toggle('dark')
  }
// dark_mode_toggle.onclick = () => {
//     document.querySelector('body').classList.toggle('light')

//
