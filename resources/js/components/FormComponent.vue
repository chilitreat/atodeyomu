<template>
  <v-container class="fill-height" fluid>
    <v-row align="center" justify="center">
      <v-col cols="12">
        <v-card class="elevation-12">
          <v-toolbar color="primary" dark flat>
            <v-toolbar-title>あとで読む</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form>
              <v-text-field v-model="url" label="URL" type="text"></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" v-on:click="submit">記事中リンク抽出</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  props: [ 'setUrls' ],
  data: function() {
    return {
      url: ''
    }
  },
  methods: {
      async submit() {
        const res = await axios.get('http://localhost/api/atodeyomu', {
          params: {
            url: this.url
          }
        });
        console.log(res.data);
        return this.setUrls(res.data);
      }
    },
};
</script>>
