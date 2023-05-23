class Api {
  constructor() {
    this.base = 'http://localhost/vue_lab/API/rest';
  }

  request = async (method, options) => {
    const url =this.base + method;
    return fetch(url, options)
  }

  rest = async (method, options) => {
    return this.request(method, options)
      .then((data) => data);
  }

}

export default Api;
