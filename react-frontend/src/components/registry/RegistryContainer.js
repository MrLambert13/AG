import React from 'react';
import {connect} from "react-redux";
import {registry} from "actions/client/UserActions";
import {push} from "connected-react-router";

class RegistryContainer extends React.Component {
  render () {
    return (
      <div>
        <h4>Регистрация аккаунта</h4>
        <form action="" id="login-form">
          <input type="text" name="username" placeholder="Username"/><br/>
          <input type="text" name="email" placeholder="Email"/><br/>
          <input type="password" name="password" placeholder="Пароль"/><br/>
          <button onClick={this.onClickHandler}>Зарегистрироваться</button>
        </form>
      </div>
    )
  }

  onClickHandler = (e) => {
    e.preventDefault();
    const data = {
      username: document.getElementById("login-form")["username"].value,
      email: document.getElementById("login-form")["email"].value,
      password: document.getElementById("login-form")["password"].value,
    };
    // const form = new FormData();
    //
    // console.log(form);

    this.props.registry('/register', data);
  }
}

const mapStateToProps = store => {
  return {
    user: store.user,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    registry: (url, data) => dispatch(registry(url, data)),
    redirect: () => dispatch(push('/login/client')),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(RegistryContainer)