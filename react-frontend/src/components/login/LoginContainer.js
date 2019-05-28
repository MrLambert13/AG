import React from 'react';
import {connect} from "react-redux";
import {login} from "actions/client/UserActions";

class LoginContainer extends React.Component {
  render () {
    return (
      <div>
        <h4>Войти в свой аккаунт</h4>
        <form action="" id="login-form">
          <input type="text" name="username" placeholder="username"/><br/>
          <input type="password" name="password" placeholder="Пароль"/><br/>
          <button onClick={this.onClickHandler}>Войти</button>
        </form>
      </div>
    )
  }

  onClickHandler = (e) => {
    e.preventDefault();

    const data = {
      username: document.getElementById("login-form")["username"].value,
      password: document.getElementById("login-form")["password"].value,
    };

    // const form = new FormData(document.getElementById('login-form'));
    // const form = new FormData();
    //
    // console.log(form);

    this.props.login('/auth', data);
  }
}

const mapStateToProps = store => {
  return {
    user: store.user,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    login: (url, data) => dispatch(login(url, data)),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(LoginContainer)