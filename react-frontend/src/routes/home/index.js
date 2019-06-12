import React from 'react';
import {Link} from 'react-router-dom';
import AutocompleteInput from 'components/common/inputs/autocomplete';
import HomeContainer from 'components/home';

export default class Home extends React.Component {
  render() {
    return (
      <div>

        {/*<div class="header">*/}
          {/*<div class="wrap-header-top">*/}
            {/*<div class="wrap-left">*/}
              {/*<div class="logo"><a href="#">АВТОГИГАНТ</a></div>*/}
              {/*<div class="city">город:</div>*/}
              {/*<select class="drop-down-city">*/}
                {/*<option>Москва</option>*/}
              {/*</select>*/}
            {/*</div>*/}
            {/*<div class="wrap-right">*/}
              {/*<a href="#">Войти /</a>*/}
              {/*<a href="#">Регистрация</a>*/}
            {/*</div>*/}
          {/*</div>*/}
          {/*<h1>Выбирай автосервисы по оптимальной цене и качеству</h1>*/}
          {/*<div class="drop-down-filters">*/}
            {/*<form>*/}
              {/*<select class="brand-car">*/}
                {/*<option>Ford</option>*/}
              {/*</select>*/}
              {/*<select class="model-car">*/}
                {/*<option>Focus</option>*/}
              {/*</select>*/}
              {/*<select class="task">*/}
                {/*<option>Замена фильтра; Диагностика...</option>*/}
              {/*</select>*/}
              {/*<button>Найти цены</button>*/}
            {/*</form>*/}
          {/*</div>*/}

          {/*<a class="causes" href="#">Не знаешь в чем причина? Опиши проблему</a>*/}
        {/*</div>*/}

        {/*<div class="content-find-map">*/}
          {/*<div class="text">Цены будут точнее, если вы также укажете:</div>*/}
          {/*<div class="drop-down-filters">*/}
            {/*<select class="year">*/}
              {/*<option>Год выпуска</option>*/}
            {/*</select>*/}
            {/*<select class="transmission">*/}
              {/*<option>КПП</option>*/}
            {/*</select>*/}
            {/*<select class="run">*/}
              {/*<option>Пробег</option>*/}
            {/*</select>*/}
            {/*<select class="city">*/}
              {/*<option>Москва</option>*/}
            {/*</select>*/}
            {/*<select class="distikt">*/}
              {/*<option>Район/Метро</option>*/}
            {/*</select>*/}
            {/*<span class="line"></span>*/}
            {/*<select class="date">*/}
              {/*<option>Дата</option>*/}
            {/*</select>*/}
            {/*<select class="time">*/}
              {/*<option>Вечер</option>*/}
            {/*</select>*/}
          {/*</div>*/}
          {/*<div class="wrap-cards-map">*/}
            {/*<div class="wrap-cards">*/}
              {/*<div class="wrap-text-on-cards">*/}
                {/*<div>Найдено 24 сервиса</div>*/}
                {/*<div>*/}
                  {/*<select class="sort-distance">*/}
                    {/*<option>по удаленности</option>*/}
                  {/*</select>*/}
                {/*</div>*/}
              {/*</div>*/}
              {/*<div class="card">*/}
                {/*<div class="wrap-left">*/}
                  {/*<div class="name-sto">Мойка-Сервис</div>*/}
                  {/*<div class="">22 отзыва</div>*/}
                  {/*<div class="">Диагностика подвески <span>от 600</span>руб.</div>*/}
                  {/*<div class="">Замена фильтра <span>от 450</span>руб.</div>*/}
                {/*</div>*/}
                {/*<div class="wrap-right">*/}
                  {/*<div class="distance-sto">2,8км от вас</div>*/}
                  {/*<div class="">пн-вс: с 07:30 до 23:00</div>*/}
                  {/*<div class="">Сейчас открыто</div>*/}
                {/*</div>*/}
              {/*</div>*/}

            {/*</div>*/}
            {/*<div class="map">*/}
              {/*<iframe*/}
                {/*src="https://yandex.ru/map-widget/v1/?um=constructor%3A4d471f55c25653c1b74bc91fb82024e7c63f9bdc94590692494ea679bd032b67&amp;source=constructor"*/}
                {/*width="549" height="373" frameborder="0"></iframe>*/}
            {/*</div>*/}
          {/*</div>*/}
        {/*</div>*/}

        {/*<div class="login">*/}
          {/*<div class="login_logo"><a href="#">АВТОГИГАНТ</a></div>*/}
          {/*<h1>Личный кабинет <span>X</span></h1>*/}

          {/*<div class="wrap-for-center">*/}
            {/*<a class="sign-in" href="#">Войти</a>*/}
            {/*<a class="sign-up" href="#">Зарегистрироваться</a>*/}

            {/*<form>*/}
              {/*<input type="email" placeholder="email"></input>*/}
              {/*<input type="password" placeholder="Пароль"></input>*/}
              {/*<input type="password" placeholder="Повторите пароль"></input>*/}
              {/*<button>Войти</button>*/}
            {/*</form>*/}
          {/*</div>*/}


        {/*</div>*/}


        <div className="jumbotron">
          <h1 className="display-4">Добро пожаловать в Автогигант!</h1>
          <hr/>
          <AutocompleteInput
            items={[{'id': 1, 'name': 'asdsdbs'}, {'id': 2, 'name': 'asdsdbs3434'}, {'id': 3, 'name': 'csdsdbs'},]}/>
          <hr/>
          <HomeContainer/>
          <p className="lead">Это простой пример блока с компонентом в стиле jumbotron для привлечения дополнительного
            внимания к содержанию или информации.</p>
          <hr className="my-4"/>
          <p>Используются служебные классы для типографики и расстояния содержимого в контейнере большего размера.</p>
          <div className="container">
            <div className="row">
              <div className="col-sm">
                <div className="lead">
                  <Link to="/login/client" className="btn btn-primary btn-lg">Войти как пользователь</Link>
                  <div><Link to="/registry/client" className="text-dark">Зарегистрироваться</Link></div>
                </div>
              </div>
              <div className="col-sm">
                <div className="lead">
                  <Link to="/login/owner" className="btn btn-primary btn-lg">Войти как владелец СТО</Link>
                  <div><Link to="/registry/owner" className="text-dark">Зарегистрироваться</Link></div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    )
  }
}
