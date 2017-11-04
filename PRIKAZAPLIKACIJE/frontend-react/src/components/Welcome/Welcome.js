import React, { Component } from 'react';
import './Welcome.css';

import { Link } from 'react-router-dom'

class Welcome extends Component {
  render() {
    return (
      
        <div className="row">
           <div className="col-md-6 col-md-offset-3">
              <h1 >Aplikacija </h1>
              <div className="welcome-buttons">
                 <button className="btn btn"><Link to="signup">Uloguj se</Link></button> 
                 <button className="btn btn-success"><Link to="signup">Registracija</Link></button> 
               </div>
            </div>     
            
         </div>
      
    );
  }
}

export default Welcome;
