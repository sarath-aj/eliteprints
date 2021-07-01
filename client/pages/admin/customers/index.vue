<template>
  <div class="content">
    <main id="main-container">
      <div class="block block-rounded">
        <div class="block-content block-content-full">
          <div class="panel panel-default">
            <h3 class="block-title mb-3">Customers</h3>
            <div class="panel-body">
              <form @submit.prevent="getRecords">
                <label for="search">Search</label>
                <div class="row row-fluid">
                  <div class="form-group col-md-3">
                    <select v-model="search.column" class="form-control">
                      <option
                        v-for="(column, index) in response.displayable"
                        :key="index"
                        :value="column"
                      >
                        {{ column }}
                      </option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <select v-model="search.operator" class="form-control">
                      <option value="equals">=</option>
                      <option value="contains">contains</option>
                      <option value="starts_with">starts with</option>
                      <option value="ends_with">ends with</option>
                      <option value="greater_than">></option>
                      <option value="less_than">&lt;</option>
                      <option value="greater_than_or_equal_to">>=</option>
                      <option value="less_than_or_equal_to">&lt;=</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <input
                        id="search"
                        v-model="search.value"
                        type="text"
                        class="form-control"
                      />
                      <span class="input-group-btn">
                        <button class="ml-2 btn btn-primary" type="submit">
                          Search
                        </button>
                      </span>
                    </div>
                  </div>
                </div>
              </form>
              <div class="row">
                <div class="form-group col-md-10">
                  <label for="filter">Quick Search Current Results</label>
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
            <div v-if="selected.length" class="panel-heading">
              <div class="dropdown mb-3">
                <button
                  id="dropdown-default-danger"
                  type="button"
                  class="btn btn-danger dropdown-toggle"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  Actions
                </button>
                <div
                  class="dropdown-menu font-size-sm"
                  aria-labelledby="dropdown-default-danger"
                >
                  <a
                    class="dropdown-item"
                    href="#"
                    @click.prevent="destroy(selected)"
                    >Delete</a
                  >
                </div>
              </div>
            </div>
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
                      v-if="canSelectItems"
                      class="text-center"
                      style="width: 80px"
                      rowspan="1"
                      colspan="1"
                    >
                      <input
                        type="checkbox"
                        :checked="filteredRecords.length === selected.length"
                        @change="toggleSelectAll"
                      />
                    </th>
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
                    <th colspan="2">ACTIONS</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(record, index) in filteredRecords" :key="index">
                    <td
                      v-if="canSelectItems"
                      class="text-center font-size-sm sorting_1"
                    >
                      <input
                        v-model="selected"
                        type="checkbox"
                        :value="record.id"
                      />
                    </td>
                    <td v-for="(columnValue, column) in record" :key="column">
                      <template
                        v-if="editing.id === record.id && isUpdatable(column)"
                      >
                        <div class="form-group">
                          <input
                            v-model="editing.form[column]"
                            type="text"
                            :placeholder="columnValue"
                            :class="{ 'is-invalid': editing.errors[column] }"
                            class="form-control"
                          />
                          <span
                            v-if="editing.errors[column]"
                            class="text-danger"
                            >{{ editing.errors[column][0] }}</span
                          >
                        </div>
                      </template>
                      <template v-else>
                        {{ columnValue }}
                      </template>
                    </td>
                    <td>
                      <a
                        v-if="editing.id !== record.id"
                        href="#"
                        title="Edit"
                        class="btn btn-sm btn-alt-primary"
                        @click.prevent="edit(record)"
                      >
                        <i class="far fa-edit text-primary"
                      /></a>
                      <template v-if="editing.id === record.id">
                        <a href="#" @click.prevent="update">Save</a><br />
                        <a href="#" @click.prevent="editing.id = null"
                          >Cancel</a
                        >
                      </template>
                    </td>
                    <td v-if="response.allow.deletion">
                      <a
                        class="btn btn-sm btn-alt-danger"
                        href="#"
                        title="Delete"
                        @click.prevent="destroy(record.id)"
                      >
                        <i class="fa fa-fw fa-times text-danger" />
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <p v-else>No results</p>
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
    const response = await $axios.get('admin/datatable/customers');
    return {
      response: response.data.data,
    };
  },
  data() {
    return {
      title: 'Customers',
      endpoint: 'admin/datatable/customers',
      creating: {
        active: false,
        form: {},
        errors: [],
      },
      editing: {
        id: null,
        form: {},
        errors: [],
      },
      sort: {
        key: 'id',
        order: 'asc',
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
      selected: [],
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
    canSelectItems() {
      return this.filteredRecords.length <= 500;
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
    edit(record) {
      this.editing.errors = [];
      this.editing.id = record.id;
      this.editing.form = _.pick(record, this.response.updatable);
    },
    update() {
      this.$axios
        .patch(`${this.endpoint}/${this.editing.id}`, this.editing.form)
        .then((response) => {
          if (response.data.data.message === 'success') {
            toastr.options = {
              positionClass: 'toast-bottom-right',
            };
            toastr.success('Customer Updated Successfully');
            this.getRecords().then(() => {
              this.editing.id = null;
              this.editing.form = null;
            });
          }
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.editing.errors = error.response.data.errors;
          }
        });
    },
    destroy(record) {
      if (!window.confirm('Are you sure you want to delete this?')) {
        return;
      }

      this.$axios.delete(`${this.endpoint}/${record}`).then((response) => {
        if (response.data.data.message === 'success') {
          toastr.options = {
            positionClass: 'toast-bottom-right',
          };
          toastr.info('Customer deleted Successfully');

          this.getRecords();

          if (this.selected.length) {
            this.toggleSelectAll();
          }
        }
      });
    },
    isUpdatable(column) {
      return this.response.updatable.includes(column);
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
