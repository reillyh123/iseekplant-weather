import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Home from './Home'
import Forecast from './Forecast'
import { BrowserRouter, Route, Switch } from 'react-router-dom';

class App extends Component {
    render() {
        return (
            <BrowserRouter>
                <div className="flex items-center justify-center h-screen bg-indigo-100">
                    <Switch>
                        <Route exact path="/" component={Home} />
                        <Route path='/forecast/:city' component={Forecast} />
                    </Switch>
                </div>
            </BrowserRouter>
        )
    }
}
ReactDOM.render(<App />, document.getElementById('app'));
