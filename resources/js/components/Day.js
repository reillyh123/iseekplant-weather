import React from 'react'
import Hour from './Hour'
import PropTypes from 'prop-types'

function Day(props) {
  const hourWeather = Object.values(props.day.weather)
  return (
    <div className="flex-1 text-gray-700 text-center bg-gray-400 px-4 py-2 m-2 my-4">
      <h2 className="font-semibold">{props.day.date}</h2>
      <div className="text-center">
        {hourWeather.length ? hourWeather.map((hour, index) => (
          <Hour key={index} hour={hour} />
          )) : null}
      </div>
    </div>
  )
}

export default Day
