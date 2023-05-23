import Api from '@/api/index';

class Funerals extends Api {

  /**
   * Вернет список всех похорон
   * @returns {Promise<Response>}
   */
  constructor() {
    super();
    this.count=0;
  }
  funerals = () => this.rest('/funerals/list.json');
  funeralsFiltered = ( id ) => this.rest('/funerals/list-filtered', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify({ id }),
  })

  /**
   * Удалит похороны по id
   * @param id
   * @returns {Promise<*>}
   */
  remove = ( id ) => this.rest('/funerals/delete-item', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify({ id }),
  }).then(() => id) // then - заглушка, пока метод ничего не возвращает

  /**
   * Создаст новую запись в таблице
   * @param funeral объект похорон, взятый из FormFuneral
   * @returns {Promise<Response>}
   */
  add = ( funeral ) => this.rest('/funerals/add-item', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify(funeral),
  }).then(() => ({...funeral, id: ++this.count})) // then - заглушка, пока метод ничего не возвращает

  /**
   * Отправит измененную запись
   * @param funeral объект похорон, взятый из FormFuneral
   * @returns {Promise<*>}
   */
  update = ( funeral ) => this.rest('/funerals/update-item', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify(funeral),
  }).then(() => ({...funeral, id: this.count})) // then - заглушка, пока метод ничего не возвращает

}

export default new Funerals();
