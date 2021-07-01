<template>
  <div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="page-title">
            <h1>{{ crumbs[0].title }}</h1>
          </div>
        </div>
        <div class="col-md-6">
          <ol
            class="breadcrumb justify-content-md-end"
            itemscope=""
            itemtype="http://schema.org/BreadcrumbList"
          >
            <li
              class="breadcrumb-item"
              itemprop="itemListElement"
              itemscope=""
              itemtype="http://schema.org/ListItem"
            >
              <meta itemprop="position" content="1" />
              <nuxt-link to="/" itemprop="item" title="Home">
                <span property="name">Home</span>
                <meta itemprop="name" content="Home" />
              </nuxt-link>
            </li>
            <li
              v-for="(crumb, index) in crumbs"
              :key="index"
              class="breadcrumb-item"
              itemprop="itemListElement"
              itemscope=""
              itemtype="http://schema.org/ListItem"
            >
              <meta
                v-if="index + 1 !== crumbs.length"
                itemprop="position"
                :content="index + 2"
              />
              <NLink
                class="breadcrumb-item"
                :class="index + 1 === crumbs.length ? 'active' : ''"
                itemprop="item"
                :title="crumb.title"
                :to="crumb.path"
              >
                <span property="name"
                  >{{
                    $route.fullPath === crumb.path && title !== null
                      ? title
                      : crumb.title
                  }}
                  <meta itemprop="name" :content="crumb.title" />
                </span>
              </NLink>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const titleCase = require('ap-style-title-case');

export default {
  props: {
    title: {
      type: String,
      default: null,
    },
  },
  computed: {
    crumbs() {
      const fullPath = this.$route.fullPath;
      const params = fullPath.startsWith('/')
        ? fullPath.substring(1).split('/')
        : fullPath.split('/');
      const crumbs = [];
      let path = '';
      params.forEach((param, index) => {
        path = `${path}/${param}`;
        const match = this.$router.match(path);
        if (match.name !== null) {
          crumbs.push({
            title: titleCase(param.replace(/-/g, ' ')),
            ...match,
          });
        }
      });
      return crumbs;
    },
  },
};
</script>
