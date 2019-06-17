import React from 'react';
import {connect} from "react-redux";
import {registry} from "actions/client/UserActions";
import {push} from "connected-react-router";
import { Link } from 'react-router-dom';
import RegistryForm from './RegistryForm';

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
        <div className="header_registry">
          <div className="header_registry_logo"><Link to="/">АВТОГИГАНТ</Link></div>
        </div>

        <div className="wrap-for-center">              
          <h1>Личный кабинет</h1>
          <p className='text_registry'>Владельца автосервиса или мастера</p>
          <p className='text_registry'>Мы предлагаем вместе создавать удобный и полезный сервис. Необходимо только оставить заявку на бесплатное подключение.</p>
          <Link to="/login/client">Войти</Link><span> </span><Link to="/registry/client">Зарегистрирроваться</Link>
               
          <div>
            <label for ="private-person">Физ. лицо</label>
            <input type="radio" id="private-person"></input>
            
            <label for="legal_person">Юр. лицо</label>
            <input type="radio" id="legal_person" checked="checked"></input>
          </div>            
          
          <RegistryForm url="/register" sendMethod={registry}/>
          
          
        </div>
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