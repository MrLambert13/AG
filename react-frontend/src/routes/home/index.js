import React from 'react';
import { Link } from 'react-router-dom';

export default class Home extends React.Component {
  render() {
    return (
      <div>
        <h1>Home page</h1>
        <ul>
          <li><Link to="/login/client">Войти</Link></li>
          <li><Link to="/registry/client">Регистрация</Link></li>
          <li><Link to="/client/cabinet/profile">Профиль</Link></li>
        </ul>
      </div>
    )
  }
}
