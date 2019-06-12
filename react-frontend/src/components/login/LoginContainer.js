import React from 'react';
import {connect} from "react-redux";
import {login} from "actions/client/UserActions";
import LoginForm from './LoginForm';
import Spinner from 'react-bootstrap/Spinner';

class LoginContainer extends React.Component {
  render () {
    const { user, login } = this.props;

    return (
      <div>  
        <h4 className="link-input-registry"><a href="/login/client">Войти</a><a href="/registry/client">Зарегистрироваться</a></h4>
        <LoginForm url="/auth" sendMethod={login}/>
        {user.isFetching && <Spinner as="span" animation="border" role="status" size="sm"/>}
        {user.authError && <div className="text-danger">{user.message}</div>}
      </div>
    )
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