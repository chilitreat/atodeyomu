<template>
  <v-container class="fill-height" fluid>
    <v-row align="center" justify="center">
      <v-col cols="12">
        <v-card class="elevation-12">
          <v-toolbar color="primary" dark flat>
            <v-toolbar-title>引用記事一覧</v-toolbar-title>
          </v-toolbar>
          <v-list>
            <v-list-item v-for="preview in linkPreviews" :key="preview.url" :href="preview.url" target="_blank">
              <v-list-item-content>
                <v-card>
                  <v-img
                    height="200px"
                    :src="preview.image"
                  ></v-img>
                  <v-card-title>{{ preview.title}}</v-card-title>
                  <v-card-subtitle>{{ preview.siteName }}</v-card-subtitle>
                  <v-card-text>{{preview.description.slice(0, 120) }}</v-card-text>
                </v-card>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>

export default {
  props: {
    linkPreviews: Array
  },
  data: function() {
    return {
      linkPreviews: this.linkPreviews,
    }
  },
};
</script>>
