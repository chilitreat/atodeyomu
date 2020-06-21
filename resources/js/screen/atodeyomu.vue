<template>
  <v-container>
    <form-component :setUrls="setUrls" />
    <list-component :linkPreviews="linkPreviews" />
  </v-container>
</template>

<script>
import axios from 'axios';
import ListComponent from '../components/ListComponent.vue';
import FormComponent from '../components/FormComponent.vue';

export default {
  components: [FormComponent, ListComponent],
  data: function() {
    return {
      urls: [],
      linkPreviews: []
    };
  },
  methods: {
    async getPreview(urls) {
      const res = await axios.get('/api/linkPreview', {
        params: { urls }
      });
      this.linkPreviews = res.data;
    },
    setUrls(urls) {
      this.urls = urls;
      this.getPreview(urls);
    }
  }
};
</script>

<style>
</style>
