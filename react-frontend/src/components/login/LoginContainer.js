import React from 'react';
import {connect} from "react-redux";
import {login} from "actions/client/UserActions";
import LoginForm from './LoginForm';
import Spinner from 'react-bootstrap/Spinner';
import {Link} from 'react-router-dom';


class LoginContainer extends React.Component {
  render () {
    const { user, login } = this.props;

    return (
      <div>
        <div className="login">
          <div className="login_logo"><Link to="/">АВТОГИГАНТ</Link></div>
          <h1>Личный кабинет <span>X</span></h1>

          <div className="wrap-for-center">
            <Link to="/login/client" className="sign-in">Войти</Link>
            <Link to="/registry/client" className="sign-up">Зарегистрироваться</Link>
            <LoginForm url="/auth" sendMethod={login}/>
            {user.isFetching && <Spinner as="span" animation="border" role="status" size="sm"/>}
            {user.authError && <div className="text-danger">{user.message}</div>}
            <br/>
          </div>
        </div>
        {/*<h4 className="link-input-registry"><a href="/login/client">Войти</a><a href="/registry/client">Зарегистрироваться</a></h4>*/}
        {/*<LoginForm url="/auth" sendMethod={login}/>*/}
        {/*{user.isFetching && <Spinner as="span" animation="border" role="status" size="sm"/>}*/}
        {/*{user.authError && <div className="text-danger">{user.message}</div>}*/}
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