import Axios from 'axios'
import React, { Component } from 'react'
import { Link } from 'react-router-dom'
import Day from './Day'
import Error from './Error'
import Loading from './Loading'

class Forecast extends Component {
  constructor (props) {
    super(props)
    this.state = {
      city: '',
      forecast: [],
      loading: true,
      errors: false,
    }
  }

  componentDidMount () {
    const cityName = this.props.match.params.city
    Axios.get(`/api/forecast/${cityName}`)
      .then(response => {
        this.setState({
          city: response.data.city,
          forecast: Object.values(response.data.forecast),
          loading: false,
        })
      })
      .catch(err => {
        console.log(err);
        this.setState({
          errors: true,
          loading: false,
        })
      })
  }

  render() {
    const { city, forecast, loading, errors } = this.state
    return (
      <div className="container mx-auto bg-white rounded-lg overflow-hidden shadow-xl border">
        <div className="p-6">
          <h2 className="mt-1 font-semibold text-lg leading-tight truncate">
              {city ? <span>{city} 5 Day Forecast</span> : ''}
          </h2>
          {errors && <Error />}
          {loading && <Loading />}
          <div className="flex">
            {forecast.length ? forecast.map((day, index) => (
              <Day key={index} day={day} />
            )) : null}
          </div>          
          <div className="flex items-baseline">
            <div className="relative">
              <Link className="btn btn-blue" to="/">
                Home
              </Link>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

export default Forecast