import React from 'react';
import {connect} from "react-redux";
import {registry} from "actions/client/UserActions";
import {push} from "connected-react-router";
import { Link } from 'react-router-dom';
import RegistryForm from 'components/layouts/forms/registry';

class RegistryContainer extends React.Component {
  render () {
    const { user, registry } = this.props;

    if (user.isRegistered) return (
      <div className="text-success">
        <span>Успешная регистрация. Войдите в свой профиль <Link to="/login/client" className="badge badge-primary">Войти</Link></span>
      </div>
    );

    return (
      <div>
        <h4>Регистрация аккаунта</h4>
        <RegistryForm url="/register" sendMethod={registry}/>
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
    registry: (url, data) => dispatch(registry(url, data)),
    redirect: () => dispatch(push('/login/client')),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(RegistryContainer)