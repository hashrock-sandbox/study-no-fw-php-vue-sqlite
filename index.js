new Vue({
  el: "#main",
  data() {
    return {
      message: "init",
      text: "",
      items: []
    }
  },
  methods: {
    fetchPosts() {
      axios
        .get("./api.php")
        .then(res => {
          this.items = res.data;
        })
    },
    createPost() {
      var params = new URLSearchParams();
      params.append('text', this.text);

      axios.post('./api.php', params)
        .then(response => {
          this.text = "";
          this.fetchPosts();
        }).catch(error => {
          console.log(error);
        });
    }
  },
  mounted() {
    this.fetchPosts();
  }
})
