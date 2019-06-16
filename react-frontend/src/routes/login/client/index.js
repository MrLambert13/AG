import React from 'react';
import LoginContainer from 'components/login';

export default class Login extends React.Component {
  render() {
    return (      
      <div className="login-client">
        {/* <h1>Личный кабинет</h1> */}
        <LoginContainer />
      </div>
    )
  }
}
