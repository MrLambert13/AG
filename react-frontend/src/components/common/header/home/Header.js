import React from 'react';
import './Header.scss';

const Header = () => {
  return (
    <div className="header">
      <div className="wrap-header-top">
        <div className="wrap-left">
          <div className="logo"><a href="#">АВТОГИГАНТ</a></div>
          <div className="city">город:</div>
          <select className="drop-down-city">
            <option>Москва</option>
          </select>
        </div>
        <div className="wrap-right">
          <a href="#">Войти /</a>
          <a href="#">Регистрация</a>
        </div>
      </div>
      <h1>Выбирай автосервисы по оптимальной цене и качеству</h1>
      <div className="drop-down-filters">
        <form>
          <select className="brand-car">
            <option>Ford</option>
          </select>
          <select className="model-car">
            <option>Focus</option>
          </select>
          <select className="task">
            <option>Замена фильтра; Диагностика...</option>
          </select>
          <button>Найти цены</button>
        </form>
      </div>

      <a className="causes" href="#">Не знаешь в чем причина? Опиши проблему</a>
    </div>
  )
};

export default Header