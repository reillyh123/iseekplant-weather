import React from 'react'
import PropTypes from 'prop-types'

function Hour(props) {
  return (
    <div>
      <hr/>
      <p>{props.hour.time} - {props.hour.temp}'C</p>
      <img className="inline-block" src={`http://openweathermap.org/img/wn/${props.hour.icon_id}.png`} />
    </div>
  )
}

export default Hour
