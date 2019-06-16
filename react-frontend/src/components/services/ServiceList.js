import React from 'react';

export default class ServiceList extends React.Component {

  state = {
    selectedItemId: ''
  };

  render() {

    const {items} = this.props;

    const onBtnChooseClickHandler = (e) => {
      // alert('Исполнитель добавлен в корзину');
      this.props.onChoose(+e.target.getAttribute('data-key'));
    };

    const listTemplate = items.map(function(sto) {
      return (
        <div className="card"  key={sto.id}>
          <div className="wrap-left">
            <div className="name-sto">{sto.info.name}</div>
            <div className="">22 отзыва</div>
            <div className="">Диагностика подвески <span>от 600</span>руб.</div>
            <div className="">Замена фильтра <span>от 450</span>руб.</div>
          </div>
          <div className="wrap-right">
            <div className="distance-sto">{sto.info.geo}</div>
            <div className="">пн-вс: с 07:30 до 23:00</div>
            <div className="">Сейчас открыто</div>
            <i>{sto.info.telephone}</i>
            <button className="btn btn-primary" data-key={sto.id} onClick={onBtnChooseClickHandler}>Выбрать исполнителем</button>
          </div>
        </div>
      )
    });

    return (
      <div>
        <div>
          <div className="wrap-cards-map">
            <div className="wrap-cards">
              <div className="wrap-text-on-cards">
                <div>Найдено {items.length} сервиса</div>
                <div>
                  <select className="sort-distance">
                    <option>по удаленности</option>
                  </select>
                </div>
              </div>

              <div className="d-flex flex-column">
                {listTemplate}
              </div>

            </div>
            {/*<div className="map">*/}
              {/*<iframe*/}
                {/*src="https://yandex.ru/map-widget/v1/?um=constructor%3A4d471f55c25653c1b74bc91fb82024e7c63f9bdc94590692494ea679bd032b67&amp;source=constructor"*/}
                {/*width="549" height="373" frameBorder="0"></iframe>*/}
            {/*</div>*/}
          </div>
        </div>
      </div>
    )
  }
}


