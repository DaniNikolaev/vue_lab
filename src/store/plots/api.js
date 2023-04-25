import Api from '@/api/index';

class Plots extends Api {

  /**
   * Вернет список всех участков
   * @returns {Promise<Response>}
   */
  constructor() {
    super();
    this.count=0;
  }
  plots = () => this.rest('/plots/list');

  /**
   * Удалит участок по id
   * @param id
   * @returns {Promise<*>}
   */
  remove = ( id ) => this.rest('/plots/delete-item', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify({ id }),
  }).then(()=>id) // then - заглушка, пока метод ничего не возвращает

  /**
   * Создаст новую запись в таблице
   * @param plot объект участка, взятый из FormPlot
   * @returns {Promise<Response>}
   */
  add = ( plot ) => this.rest('/plots/add-item', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify(plot),
  }).then(() => ({...plot, id: ++this.count})) // then - заглушка, пока метод ничего не возвращает

  /**
   * Отправит измененную запись
   * @param plot объект участка, взятый из FormPlot
   * @returns {Promise<*>}
   */
  update = ( plot ) => this.rest('/plots/update-item', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify(plot),
  }).then(() => ({...plot, id: this.count})) // then - заглушка, пока метод ничего не возвращает

}

export default new Plots();
