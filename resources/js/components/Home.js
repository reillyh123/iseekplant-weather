import React, { Component } from 'react';
import { Link } from 'react-router-dom';

class Home extends Component {
  constructor () {
    super()
    this.state = {
      city: 'cairns',
    }
    this.handleCityChange = this.handleCityChange.bind(this);
  }

  handleCityChange (event) {
    this.setState({
      city: event.target.value
    });
  }

  render() {
    return (
      <div className="container mx-auto bg-white rounded-lg overflow-hidden shadow-xl border shadow-lg">
        <div className="p-6">
          <div className="flex items-baseline">
            <h2 className="mt-1 font-semibold text-lg leading-tight truncate">
              Weather checker
            </h2>
          </div>
          <div className="flex items-baseline">
            <p className="text-gray-600 text-sm">
              Select a city from the list bellow to check the 5-day forecast
            </p>
          </div>
          <div className="flex items-baseline">
            <div className="my-4 relative">
              <select className="block appearance-none w-full select-dropdown" id="grid-state" value={this.state.city} onChange={this.handleCityChange}>
                <option value="cairns">Cairns</option>
                <option value="perth">Perth</option>
                <option value="brisbane">Brisbane</option>
                <option value="wagga-wagga">Wagga Wagga</option>
                <option value="doesnt-exist">Doesnt Exist</option>
              </select>
              <div className="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg className="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
              </div>
            </div>
          </div>
          <div className="flex items-baseline">
            <div className="relative">
              <Link className="btn btn-blue" to={`/forecast/${this.state.city}`} >
                View Forecast
              </Link>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

export default Home