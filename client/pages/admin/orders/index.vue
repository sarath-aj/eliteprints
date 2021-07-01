<template>
  <div class="content">
    <main id="main-container">
      <div class="block block-rounded">
        <div class="block-content block-content-full">
          <div class="panel panel-default">
            <h3 class="block-title mb-3">Orders</h3>
            <div class="panel-body">
              <div class="row">
                <div class="form-group col-md-10">
                  <label for="filter">Quick search current results</label>
                  <input
                    id="filter"
                    v-model="quickSearchQuery"
                    type="text"
                    class="form-control"
                  />
                </div>
                <div class="form-group col-md-2">
                  <label for="limit">Display records</label>
                  <select
                    id="limit"
                    v-model="limit"
                    class="form-control"
                    @change="getRecords"
                  >
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="1000">1000</option>
                    <option value="">All</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div
            id="DataTables_Table_0_wrapper"
            class="dataTables_wrapper dt-bootstrap4 no-footer"
          >
            <div class="panel panel-default">
              <div class="panel-body">
                <div v-if="filteredRecords.length" class="table-responsive">
                  <table
                    id="DataTables_Table_0"
                    class="
                      table table-bordered table-striped table-vcenter
                      js-dataTable-full
                      dataTable
                      no-footer
                    "
                    role="grid"
                  >
                    <thead>
                      <tr role="row">
                        <th
                          v-for="(column, index) in response.displayable"
                          :key="index"
                        >
                          <span class="sortable" @click="sortBy(column)">{{
                            response.column_map[column] || column
                          }}</span>
                          <span
                            v-if="sort.key === column"
                            class="arrow"
                            :class="{
                              'arrow--asc': sort.order === 'asc',
                              'arrow--desc': sort.order === 'desc',
                            }"
                          />
                        </th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(record, index) in filteredRecords"
                        :key="index"
                      >
                        <td
                          v-for="(columnValue, column) in record"
                          :key="column"
                        >
                          <!-- eslint-disable -->
                          <template>
                            {{ columnValue }}
                          </template>
                          <!-- eslint-enable -->
                        </td>
                        <td>
                          <nuxt-link
                            :to="{
                              name: 'admin-orders-view-id',
                              params: { id: record.ID },
                            }"
                            class="btn btn-sm btn-alt-secondary"
                            title="View"
                          >
                            <i class="fa fa-fw fa-eye" />
                          </nuxt-link>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <p v-else>No results</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>
<script>
import queryString from 'query-string';

export default {
  layout: 'admin',
  middleware: 'auth-admin',
  async asyncData({ $axios, params, app }) {
    const response = await $axios.get('admin/datatable/orders');
    return {
      response: response.data.data,
    };
  },
  data() {
    return {
      title: 'Orders',
      endpoint: 'admin/datatable/orders',
      sort: {
        key: 'id',
        order: 'desc',
      },
      search: {
        column: 'id',
        operator: 'equals',
        value: null,
      },
      quickSearchQuery: '',
      limit: 50,
      response: {
        table: null,
        records: [],
        displayable: [],
        updatable: [],
        allow: [],
      },
    };
  },

  head() {
    return {
      title: this.title,
      meta: [
        {
          hid: 'robots',
          name: 'robots',
          content: 'noindex,nofollow',
        },
      ],
    };
  },
  computed: {
    filteredRecords() {
      let data = this.response.records;

      data = data.filter((row) => {
        return Object.keys(row).some((key) => {
          return String(row[key])
            .toLowerCase()
            .includes(this.quickSearchQuery.toLowerCase());
        });
      });

      if (this.sort.key) {
        data = _.orderBy(
          data,
          (i) => {
            const value = i[this.sort.key];

            if (!isNaN(parseFloat(value)) && isFinite(value)) {
              return parseFloat(value);
            }

            return String(i[this.sort.key]).toLowerCase();
          },
          this.sort.order
        );
      }

      return data;
    },
  },
  methods: {
    getRecords() {
      return this.$axios
        .get(`${this.endpoint}?${this.getQueryParameters()}`)
        .then((response) => {
          this.response = response.data.data;
        });
    },
    getQueryParameters() {
      return queryString.stringify({
        limit: this.limit,
        ...this.search,
      });
    },
    sortBy(key) {
      this.sort.key = key;
      this.sort.order = this.sort.order === 'asc' ? 'desc' : 'asc';
    },
    toggleSelectAll() {
      if (this.selected.length > 0) {
        this.selected = [];
        return;
      }

      this.selected = _.map(this.filteredRecords, 'id');
    },
  },
};
</script>
