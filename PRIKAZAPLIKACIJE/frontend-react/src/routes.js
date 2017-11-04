import React from 'react';

import {
  BrowserRouter as Router,
  Route,
  Link,
  Switch
} from 'react-router-dom';

import Welcome from './components/Welcome/Welcome';
import Login from './components/Login/Login';
import Signup from './components/Signup/Signup';
import Home from './components/Home/Home';
import NotFound from './components/NotFound/NotFound';

const Routes =()=>(
     <Router> 
        <Switch>
            <Route exact path="/" component={Welcome} />
            <Route  path="/login" component={Login} />
            <Route  path="/signup" component={Signup} />
            <Route  path="/home" component={Home} />
            <Route  path="#" component={NotFound} />

        </Switch>

    </Router>

	);

export default Routes;