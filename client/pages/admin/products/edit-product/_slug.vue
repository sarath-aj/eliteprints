<template>
  <main id="main-container">
    <!-- Page Content -->
    <div class="content">
      <!-- Info -->
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">EDIT PRODUCT</h3>
        </div>
        <div class="block-content">
          <div class="row justify-content-start">
            <div class="col-md-6 col-lg-6">
              <form @submit.prevent="submitForm">
                <div class="form-group">
                  <label for="one-ecom-product-code">Product Code</label>
                  <input
                    id="one-ecom-product-code"
                    v-model="form.product_code"
                    type="text"
                    class="form-control"
                    @keydown="form.errors.clear('product_code')"
                  />
                  <span
                    v-if="
                      !$v.form.product_code.required &&
                      $v.form.product_code.$dirty
                    "
                    class="text-danger"
                    >The product code field is required.</span
                  >
                  <span
                    v-else-if="
                      !$v.form.product_code.maxLength &&
                      $v.form.product_code.$dirty
                    "
                    class="text-danger"
                    >The product code must not be more than 255
                    characters.</span
                  >
                  <span
                    v-if="form.errors.has('product_code')"
                    class="text-danger"
                    v-text="form.errors.get('product_code')"
                  />
                </div>
                <div class="form-group">
                  <label for="one-ecom-product-name">Product Name</label>
                  <input
                    id="one-ecom-product-name"
                    v-model="form.name"
                    type="text"
                    class="form-control"
                    @keydown="form.errors.clear('name')"
                  />
                  <span
                    v-if="!$v.form.name.required && $v.form.name.$dirty"
                    class="text-danger"
                    >The product name field is required.</span
                  >
                  <span
                    v-else-if="!$v.form.name.maxLength && $v.form.name.$dirty"
                    class="text-danger"
                    >The product name must not be more than 255
                    characters.</span
                  >
                  <span
                    v-if="form.errors.has('name')"
                    class="text-danger"
                    v-text="form.errors.get('name')"
                  />
                </div>
                <div class="form-group">
                  <label for="one-ecom-product-slug">Product Slug</label>
                  <input
                    id="one-ecom-product-slug"
                    v-model="form.slug"
                    type="text"
                    class="form-control"
                    @keydown="form.errors.clear('slug')"
                  />
                  <span
                    v-if="!$v.form.slug.required && $v.form.slug.$dirty"
                    class="text-danger"
                    >The slug field is required.</span
                  >
                  <span
                    v-else-if="!$v.form.slug.maxLength && $v.form.slug.$dirty"
                    class="text-danger"
                    >The slug must not be more than 255 characters.</span
                  >
                  <span
                    v-if="form.errors.has('slug')"
                    class="text-danger"
                    v-text="form.errors.get('slug')"
                  />
                </div>
                <div class="form-group">
                  <label for="one-ecom-product-description-short"
                    >Description</label
                  >
                  <textarea
                    id="one-ecom-product-description-short"
                    v-model="form.description"
                    class="form-control"
                    rows="4"
                    @keydown="form.errors.clear('description')"
                  />
                  <span
                    v-if="
                      !$v.form.description.required &&
                      $v.form.description.$dirty
                    "
                    class="text-danger"
                    >The description field is required.</span
                  >
                  <span
                    v-else-if="
                      !$v.form.description.maxLength &&
                      $v.form.description.$dirty
                    "
                    class="text-danger"
                    >The description must not be more than 400 characters.</span
                  >
                  <span
                    v-if="form.errors.has('description')"
                    class="text-danger"
                    v-text="form.errors.get('description')"
                  />
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="one-ecom-product-price">Price in USD ($)</label>
                    <vue-autonumeric
                      id="one-ecom-product-price"
                      v-model="form.price"
                      class="form-control"
                      :options="options"
                      @keydown="form.errors.clear('price')"
                    />
                    <span
                      v-if="!$v.form.price.required && $v.form.price.$dirty"
                      class="text-danger"
                      >The price field is required.</span
                    >
                    <span
                      v-if="!$v.form.price.numeric && $v.form.price.$dirty"
                      class="text-danger"
                      >The price field must be a number.</span
                    >
                    <span
                      v-if="
                        !$v.form.price.price_greater_than_zero &&
                        $v.form.price.$dirty
                      "
                      class="text-danger"
                      >The price must be greater than zero.</span
                    >

                    <span
                      v-if="form.errors.has('price')"
                      class="text-danger"
                      v-text="form.errors.get('price')"
                    />
                  </div>
                </div>

                <div class="form-group">
                  <label for="one-ecom-product-brand">Brand</label>
                  <select
                    id="one-ecom-product-brand"
                    v-model="form.brand_id"
                    class="form-control"
                    @change="form.errors.clear('brand_id')"
                  >
                    <option value="">Please Select Brand</option>
                    <option
                      v-for="brand in brands"
                      :key="brand.id"
                      :value="brand.id"
                      :selected="brand.id === form.brand_id"
                    >
                      {{ brand.name }}
                    </option>
                  </select>
                  <span
                    v-if="!$v.form.brand_id.required && $v.form.brand_id.$dirty"
                    class="text-danger"
                    >Please select brand</span
                  >
                  <span
                    v-if="form.errors.has('brand_id')"
                    class="text-danger"
                    v-text="form.errors.get('brand_id')"
                  />
                </div>
                <div class="form-group">
                  <label for="one-ecom-product-gender">Gender</label>
                  <select
                    id="one-ecom-product-gender"
                    v-model="form.gender"
                    class="form-control"
                    style="width: 100%"
                    @change="form.errors.clear('gender')"
                  >
                    <option value="">Please Select Gender</option>
                    <option value="men">Men</option>
                    <option value="women">Women</option>
                  </select>
                  <span
                    v-if="!$v.form.gender.required && $v.form.gender.$dirty"
                    class="text-danger"
                    >Please select gender</span
                  >
                  <span
                    v-if="form.errors.has('gender')"
                    class="text-danger"
                    v-text="form.errors.get('gender')"
                  />
                </div>
                <div class="form-group">
                  <label for="one-ecom-product-occasion">occasion</label>
                  <select
                    id="one-ecom-product-occasion"
                    v-model="form.occasion"
                    class="form-control"
                    style="width: 100%"
                    @change="form.errors.clear('occasion')"
                  >
                    <option value="">Please Select occasion</option>
                    <option value="sports">Sports</option>
                    <option value="casual">Casual</option>
                    <option value="formal">Formal</option>
                    <option value="party">Party</option>
                    <option value="beach Wear">Beach Wear</option>
                    <option value="lounge Wear">Lounge Wear</option>
                  </select>
                  <span
                    v-if="!$v.form.occasion.required && $v.form.occasion.$dirty"
                    class="text-danger"
                    >Please select occasion</span
                  >

                  <span
                    v-if="form.errors.has('occasion')"
                    class="text-danger"
                    v-text="form.errors.get('occasion')"
                  />
                </div>
                <div class="form-group">
                  <label for="one-ecom-product-color">Product Color</label>
                  <input
                    id="one-ecom-product-color"
                    v-model="form.color"
                    type="text"
                    class="form-control"
                    @keydown="form.errors.clear('color')"
                  />
                  <span
                    v-if="!$v.form.color.required && $v.form.color.$dirty"
                    class="text-danger"
                    >The color field is required</span
                  >
                  <span
                    v-else-if="!$v.form.color.maxLength && $v.form.color.$dirty"
                    class="text-danger"
                    >The color field must not be more than 60 characters.</span
                  >
                  <span
                    v-if="form.errors.has('color')"
                    class="text-danger"
                    v-text="form.errors.get('color')"
                  />
                </div>
                <div class="form-group">
                  <label for="one-ecom-product-sleeve">Sleeve Type</label>
                  <select
                    id="one-ecom-product-sleeve"
                    v-model="form.sleeve"
                    class="form-control"
                    style="width: 100%"
                    @change="form.errors.clear('sleeve')"
                  >
                    <option value="">Please Select Sleeve Type</option>
                    <option value="full">Full Sleeve</option>
                    <option value="half">Half Sleeve</option>
                    <option value="sleeveless">Sleeveless</option>
                    <option value="short">Short Sleeve</option>
                  </select>
                  <span
                    v-if="!$v.form.sleeve.required && $v.form.sleeve.$dirty"
                    class="text-danger"
                    >Please select sleeve type</span
                  >

                  <span
                    v-if="form.errors.has('sleeve')"
                    class="text-danger"
                    v-text="form.errors.get('sleeve')"
                  />
                </div>

                <div class="form-group">
                  <label for="one-ecom-product-neck">Neck Type</label>
                  <select
                    id="one-ecom-product-neck"
                    v-model="form.neck"
                    class="form-control"
                    style="width: 100%"
                    @change="form.errors.clear('neck')"
                  >
                    <option value="">Please Select Neck Type</option>
                    <option value="polo">Polo Neck</option>
                    <option value="round">Round Neck</option>
                    <option value="collared">Collared Neck</option>
                    <option value="v">V Neck</option>
                    <option value="hooded">Hooded Neck</option>
                  </select>
                  <span
                    v-if="!$v.form.neck.required && $v.form.neck.$dirty"
                    class="text-danger"
                    >Please select neck type</span
                  >

                  <span
                    v-if="form.errors.has('neck')"
                    class="text-danger"
                    v-text="form.errors.get('neck')"
                  />
                </div>

                <div class="form-group">
                  <label for="one-ecom-product-fit">Fit Type</label>
                  <select
                    id="one-ecom-product-fit"
                    v-model="form.fit"
                    class="form-control"
                    style="width: 100%"
                    @change="form.errors.clear('fit')"
                  >
                    <option value="">Please Select Fit Type</option>
                    <option value="boxy">Boxy</option>
                    <option value="compression">Compression</option>
                    <option value="loose">Loose</option>
                    <option value="slim">Regular</option>
                  </select>
                  <span
                    v-if="!$v.form.fit.required && $v.form.fit.$dirty"
                    class="text-danger"
                    >Please select fit type</span
                  >

                  <span
                    v-if="form.errors.has('fit')"
                    class="text-danger"
                    v-text="form.errors.get('fit')"
                  />
                </div>
                <div class="form-group">
                  <label>Featured?</label>
                  <div class="custom-control custom-switch mb-1">
                    <input
                      id="one-ecom-product-featured"
                      v-model="form.featured"
                      type="checkbox"
                      class="custom-control-input"
                      checked=""
                    />
                    <label
                      class="custom-control-label"
                      for="one-ecom-product-featured"
                    />
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-alt-success">
                    Update Product
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- END Info -->

      <!-- PRODUCT VAIRATION -->
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">PRODUCT VARIATIONS</h3>
        </div>
        <div class="block-content block-content-full">
          <table class="table table-vcenter">
            <thead class="thead-light">
              <tr>
                <th class="text-center" style="width: 50px">Size</th>
                <th class="text-center" style="width: 50px">Price</th>
                <th class="text-center" style="width: 50px">Stock</th>
                <th class="text-center" style="width: 100px">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(variation, k) in form.variations.Size" :key="k">
                <th class="text-center">
                  {{ variation.name }}
                </th>
                <td class="text-center">
                  {{ variation.price }}
                </td>
                <td class="text-center">
                  {{ variation.stock_count }}
                </td>
                <td class="text-center">
                  <div class="btn-group">
                    <button
                      type="button"
                      class="btn btn-sm btn-light"
                      data-toggle="modal"
                      data-target="#modal-block-update-variations"
                      @click.prevent="updateVariationFormValues(variation.id)"
                    >
                      <i class="fa fa-fw fa-pencil-alt" />
                    </button>
                    <button
                      type="button"
                      class="btn btn-sm btn-light"
                      @click.prevent="deleteVariation(variation.id)"
                    >
                      <i class="fa fa-fw fa-times" />
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

          <button
            v-if="!fullySelected"
            type="button"
            class="btn btn-alt-primary push"
            data-toggle="modal"
            data-target="#modal-block-vcenter"
            @click="addVariation"
          >
            Add more variations
          </button>
        </div>

        <!-- Vertically Centered Block Modal -->
        <div
          id="modal-block-vcenter"
          class="modal"
          tabindex="-1"
          role="dialog"
          aria-labelledby="modal-block-vcenter"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div
                class="block block-rounded block-themed block-transparent mb-0"
              >
                <div class="block-header bg-primary-dark">
                  <h3 class="block-title">Add New Variation</h3>
                  <div class="block-options">
                    <button
                      type="button"
                      class="btn-block-option"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      <i class="fa fa-fw fa-times" />
                    </button>
                  </div>
                </div>
                <div class="block-content font-size-sm">
                  <div class="row">
                    <div class="col-6 col-md-8 mb-3">
                      <label for="one-ecom-product-size">Select Size</label>
                      <select
                        id="one-ecom-product-size"
                        v-model="newVariation.name"
                        class="form-control"
                        @change="newVariation.errors.clear('name')"
                      >
                        <option
                          v-for="(size, index) in newVariation.sizesOptions"
                          :key="index"
                          :value="size"
                        >
                          {{ size }}
                        </option>
                      </select>
                      <span
                        v-if="newVariation.errors.has('name')"
                        class="text-danger"
                        v-text="newVariation.errors.get('name')"
                      />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 col-md-8 mb-3">
                      <label for="one-ecom-product-variation-price"
                        >Price in USD ($)</label
                      >
                      <vue-autonumeric
                        id="one-ecom-product-variation-price"
                        v-model="newVariation.price"
                        class="form-control"
                        :options="options"
                      />
                      <span
                        v-if="newVariation.errors.has('price')"
                        class="text-danger"
                        v-text="newVariation.errors.get('price')"
                      />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 col-md-8">
                      <label for="one-ecom-product-stock">Stock</label>
                      <input
                        id="one-ecom-product-stock"
                        v-model="newVariation.stock_count"
                        type="number"
                        class="form-control"
                        @keydown="newVariation.errors.clear('stock_count')"
                      />
                      <span
                        v-if="newVariation.errors.has('stock_count')"
                        class="text-danger"
                        v-text="newVariation.errors.get('stock_count')"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="block-content block-content-full text-left">
                <!-- <button @click="addVariationToProduct" type="button" class="btn btn-primary" data-dismiss="modal">Add</button> -->
                <button
                  type="button"
                  class="btn btn-primary"
                  @click="addVariationToProduct"
                >
                  Add
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Vertically Centered Block Modal For Update Variation -->
        <div
          id="modal-block-update-variations"
          class="modal"
          tabindex="-1"
          role="dialog"
          aria-labelledby="modal-block-update-variations"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div
                class="block block-rounded block-themed block-transparent mb-0"
              >
                <div class="block-header bg-primary-dark">
                  <h3 class="block-title">Update Variation</h3>
                  <div class="block-options">
                    <button
                      type="button"
                      class="btn-block-option"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      <i class="fa fa-fw fa-times" />
                    </button>
                  </div>
                </div>
                <div class="block-content font-size-sm">
                  <div class="row">
                    <div class="col-6 col-md-8 mb-3">
                      <label for="one-ecom-product-size">Size</label>
                      <select
                        id="one-ecom-product-size"
                        v-model="updateVariation.name"
                        class="form-control"
                        @change="updateVariation.errors.clear('name')"
                      >
                        <option :value="updateVariation.name">
                          {{ updateVariation.name }}
                        </option>
                      </select>
                      <span
                        v-if="updateVariation.errors.has('name')"
                        class="text-danger"
                        v-text="updateVariation.errors.get('name')"
                      />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 col-md-8 mb-3">
                      <label for="one-ecom-product-variation-price"
                        >Price in USD ($)</label
                      >
                      <vue-autonumeric
                        id="one-ecom-product-variation-price"
                        v-model="updateVariation.price"
                        class="form-control"
                        :options="options"
                      />
                      <span
                        v-if="updateVariation.errors.has('price')"
                        class="text-danger"
                        v-text="updateVariation.errors.get('price')"
                      />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 col-md-8">
                      <label for="one-ecom-product-stock">Stock</label>
                      <input
                        id="one-ecom-product-stock"
                        v-model="updateVariation.stock_count"
                        type="number"
                        class="form-control"
                      />
                      <span
                        v-if="updateVariation.errors.has('stock_count')"
                        class="text-danger"
                        v-text="updateVariation.errors.get('stock_count')"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="block-content block-content-full text-left">
                <button
                  type="button"
                  class="btn btn-primary"
                  @click="updateProductVariation"
                >
                  Update
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END Vertically Centered Block Modal -->

      <!-- Main Image -->
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">Main Image</h3>
        </div>
        <div class="block-content block-content-full">
          <div class="multiple-upload">
            <div class="d-flex justify-content-start">
              <div
                class="
                  upload-container
                  d-flex
                  justify-content-center
                  align-items-center
                "
              >
                <input
                  id="single-file-upload"
                  ref="mainImageUploader"
                  type="file"
                  class="input-uploader"
                  accept=".jpg,.jpeg,.png"
                  @change="mainImageInserted"
                />
                <img class="uploader-icon" src="/images/upload.png" alt />
              </div>
            </div>

            <div class="d-flex flex-wrap mt-3">
              <div class="row items-push">
                <div class="animated fadeIn">
                  <div
                    class="options-container"
                    style="max-width: 325px; max-height: 400px"
                  >
                    <img
                      v-if="form.main_image"
                      class="img-fluid options-item"
                      :src="backendURL + form.main_image"
                      alt="Product Main image"
                    />
                  </div>
                </div>
              </div>
              <span
                v-if="!$v.form.main_image.required && $v.form.main_image.$dirty"
                class="text-danger"
                >Main image is required</span
              >
              <span
                v-if="form.errors.has('main_image')"
                class="text-danger"
                v-text="form.errors.get('main_image')"
              />
            </div>
          </div>
        </div>
      </div>

      <!-- Image Gallery -->
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">Image Gallery</h3>
        </div>
        <div class="block-content block-content-full">
          <div class="multiple-upload">
            <div v-if="isUploading" class="progress push mt-3">
              <div
                class="
                  progress-bar progress-bar-striped progress-bar-animated
                  bg-success
                "
                role="progressbar"
                :style="{ width: value + '%' }"
              >
                <span class="font-size-sm font-w600">{{ value }}%</span>
              </div>
            </div>
            <div class="d-flex justify-content-start">
              <div
                class="
                  upload-container
                  d-flex
                  justify-content-center
                  align-items-center
                "
              >
                <input
                  id="multi-file-upload"
                  ref="imageUploader"
                  multiple
                  type="file"
                  class="input-uploader"
                  accept=".jpg,.jpeg,.png"
                  @change="imagesInserted"
                />
                <img class="uploader-icon" src="/images/upload.png" alt />
              </div>
            </div>

            <div class="d-flex flex-wrap mt-3">
              <div class="row items-push">
                <div
                  v-for="(img, key) in form.image_gallery"
                  :key="key"
                  class="col-3 animated fadeIn"
                >
                  <div
                    class="options-container"
                    style="max-width: 350px; max-height: 400px"
                  >
                    <img
                      class="img-fluid options-item"
                      :src="backendURL + img"
                      alt="Responsive image"
                    />
                    <div class="options-overlay bg-black-75">
                      <div class="options-overlay-content">
                        <a
                          class="btn btn-sm btn-light"
                          href="#"
                          @click.prevent="deleteImageFromImageGallery(key)"
                        >
                          <i class="fa fa-times text-danger mr-1" /> Delete
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <span
                v-if="form.errors.has('image_gallery')"
                class="text-danger"
                v-text="form.errors.get('image_gallery')"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END CONTENT -->
  </main>
</template>
<script>
import {
  required,
  maxLength,
  numeric,
  integer,
} from 'vuelidate/lib/validators';
import Form from '@/static/js/Form.js';
import VueAutonumeric from '@/node_modules/vue-autonumeric/src/components/VueAutonumeric.vue';

export default {
  components: {
    VueAutonumeric,
  },
  layout: 'admin',
  middleware: ['auth-admin'],
  async asyncData({ $axios, params, app }) {
    const product = await $axios.$get(`admin/products/${params.slug}`);
    const brands = await $axios.$get('admin/brands');

    return {
      brands: brands.data,
      form: product.data,
    };
  },
  data() {
    return {
      options: {
        alwaysAllowDecimalCharacter: true,
        caretPositionOnFocus: 'start',
        currencySymbol: '$',
      },
      brands: [],
      value: 0,
      files: [],
      imageLimit: 5,
      imageSizeLimit: 2 * 1024 * 1024, // 2 MB
      isUploading: false,
      sizesList: ['S', 'M', 'L', 'XL', 'XXL'],
      newVariation: new Form({
        name: '',
        sizesOptions: '',
        price: '',
        stock_count: '',
      }),
      updateVariation: new Form({
        name: '',
        price: '',
        stock_count: '',
      }),
      fullySelected: false,
      form: new Form({
        product_code: '',
        name: '',
        slug: '',
        description: '',
        price: '',
        featured: 0,
        brand_id: '',
        occasion: '',
        gender: '',
        sleeve: '',
        neck: '',
        color: '',
        fit: '',
        main_image: '',
      }),
    };
  },
  head() {
    return {
      title: 'Edit Product ' + this.form.name,
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
    backendURL() {
      return process.env.backendURL;
    },
  },
  watch: {
    'form.featured'(val) {
      this.form.featured = val ? 1 : 0;
    },
  },
  created() {
    if (!this.brands.length) {
      if (process.client) {
        alert('Please add atleast one brand');
        this.$router.push('/admin/brands');
      }
    }

    this.form = new Form(this.form);
    this.setChecked();
    if (this.form.variations && this.form.variations.Size) {
      if (this.form.variations.Size.length === 5) {
        this.fullySelected = true;
      }
    }
  },
  validations: {
    form: {
      product_code: {
        required,
        maxLength: maxLength(255),
      },
      name: {
        required,
        maxLength: maxLength(255),
      },
      slug: {
        required,
        maxLength: maxLength(255),
      },
      description: {
        required,
        maxLength: maxLength(400),
      },
      price: {
        required,
        numeric,
        price_greater_than_zero(value) {
          if (value > 0) {
            return true;
          }
          return false;
        },
      },
      brand_id: {
        required,
        integer,
      },
      occasion: {
        required,
      },
      gender: {
        required,
      },
      sleeve: {
        required,
      },
      neck: {
        required,
      },
      color: {
        required,
        maxLength: maxLength(60),
      },
      fit: {
        required,
      },
      main_image: {
        required,
      },
    },
  },
  methods: {
    setChecked() {
      if (this.form.featured === 1) {
        this.form.featured = true;
      }
    },
    async deleteImageFromImageGallery(key) {
      const self = this;
      try {
        await this.$axios
          .delete(`admin/products/${this.form.id}/${key}`)
          .then(function (response) {
            if (response.data.message === 'success') {
              self.form.image_gallery = response.data.image_gallery_path;
              toastr.options = {
                positionClass: 'toast-bottom-right',
              };
              toastr.success('Image Deleted Successfully');
            }
          });
      } catch (error) {
        if (error.response.status === 422) {
          this.form.errors.record(error.response.data);
        }
      }
    },
    isFileTypeValid(files) {
      let isValid = true;
      _.forEach(files, function (file) {
        const idxDot = file.name.lastIndexOf('.') + 1;
        const extFile = file.name
          .substr(idxDot, file.name.length)
          .toLowerCase();
        if (!['jpg', 'jpeg', 'png'].includes(extFile)) {
          isValid = false;
          return false;
        }
      });
      return isValid;
    },
    isImageSizeValid(files) {
      const limit = this.imageSizeLimit;
      let isValidSize = true;
      _.forEach(files, function (file) {
        if (file.size > limit) {
          isValidSize = false;
          return false;
        }
      });
      return isValidSize;
    },
    validateLimit(files) {
      if (
        this.$refs.imageUploader.files.length > this.imageLimit ||
        this.$refs.imageUploader.files.length + this.form.image_gallery.length >
          this.imageLimit
      ) {
        return false;
      }
      return true;
    },
    async mainImageInserted() {
      const self = this;
      if (!this.isFileTypeValid(this.$refs.mainImageUploader.files)) {
        toastr.error('Please select only images');
        return;
      }
      if (!this.isImageSizeValid(this.$refs.mainImageUploader.files)) {
        toastr.error('Image size cannot be more than 2 MB');
        return;
      }
      const newMainImage = this.$refs.mainImageUploader.files[0];
      if (newMainImage) {
        const formData = new FormData();
        formData.append('main_image', newMainImage);
        try {
          await this.$axios
            .post(`admin/products/main-image-upload/${this.form.id}`, formData)
            .then(function (response) {
              if (response.data.message === 'success') {
                self.form.main_image = response.data.main_image_path;
                toastr.options = {
                  positionClass: 'toast-bottom-right',
                };
                toastr.success('Main Image Updated Successfully');
              }
            });
        } catch (error) {
          if (error.response.status === 422) {
            this.form.errors.record(error.response.data);
          }
        }
      }
    },
    async imagesInserted() {
      if (!this.isFileTypeValid(this.$refs.imageUploader.files)) {
        toastr.error('Please select only images');
        return;
      }
      if (!this.isImageSizeValid(this.$refs.imageUploader.files)) {
        toastr.error('Image size cannot be more than 2 MB');
        return;
      }
      if (!this.validateLimit()) {
        toastr.error('Maximum ' + this.imageLimit + ' images are allowed');
        return;
      }

      //   if (this.files) {
      //     for (let i = 0; i < this.files.length; i++) {
      //       const file = this.files[i];
      //     }
      //   }
      this.files = this.$refs.imageUploader.files;
      const self = this;
      if (this.files.length) {
        const formData = new FormData();
        _.forEach(this.files, (file) => {
          formData.append('image_gallery[]', file);
        });
        try {
          await this.$axios
            .post(
              `admin/products/image-gallery-upload/${this.form.id}`,
              formData
            )
            .then(function (response) {
              if (response.data.message === 'success') {
                self.form.image_gallery = response.data.image_gallery_path;
                toastr.options = {
                  positionClass: 'toast-bottom-right',
                };
                toastr.success('Image Added Successfully');
              }
            });
        } catch (error) {
          if (error.response.status === 422) {
            this.form.errors.record(error.response.data);
          }
        }
      }
    },
    addVariation() {
      this.newVariation.sizesOptions = this.getSizesList();
    },
    async addVariationToProduct() {
      const self = this;
      try {
        await this.$axios
          .post(`admin/product-variation/${this.form.id}`, this.newVariation)
          .then(function (response) {
            if (response.data.message === 'success') {
              self.form.variations = response.data.data.variations;
              if (response.data.data.variations.Size.length === 5) {
                self.fullySelected = true;
              }

              self.newVariation.name = '';
              self.newVariation.sizesOptions = '';
              self.newVariation.price = '';
              self.newVariation.stock_count = '';

              toastr.options = {
                positionClass: 'toast-bottom-right',
              };
              toastr.success('Variation Added Successfully');
              $('#modal-block-vcenter').modal('toggle');
              $('div').removeClass('modal-backdrop');
            }
          });
      } catch (error) {
        if (error.response.status === 422) {
          this.newVariation.errors.record(error.response.data);
        }
      }
    },
    getSizesList() {
      if (!this.form.variations.Size) {
        const list = ['S', 'M', 'L', 'XL', 'XXL'];
        return list;
      }

      const selectedValues = [];
      this.form.variations.Size.forEach(function (size) {
        selectedValues.push(size.name);
      });

      const list = this.sizesList.filter(function (value, index) {
        return !selectedValues.includes(value);
      });

      list.length === 1
        ? (this.fullySelected = true)
        : (this.fullySelected = false);

      return list;
    },

    deleteVariation(id) {
      if (!window.confirm('Are you sure you want to delete this?')) {
        return;
      }

      const self = this;
      this.$axios
        .delete(`admin/product-variation/${id}/${this.form.id}`)
        .then((response) => {
          if (response.data.message === 'success') {
            toastr.options = {
              positionClass: 'toast-bottom-right',
            };
            toastr.success('Variation Deleted Successfully');
            self.form.variations = response.data.data.variations;
            if (response.data.data.variations.Size.length < 5) {
              self.fullySelected = false;
            }
          }
        });
    },
    updateVariationModal(id) {},
    updateVariationFormValues(id) {
      this.updateVariation = new Form(
        this.form.variations.Size.find((variation) => variation.id === id)
      );
    },
    async updateProductVariation(id) {
      const self = this;
      try {
        await this.$axios
          .put(
            `admin/product-variation/${this.updateVariation.id}/${this.form.id}`,
            this.updateVariation
          )
          .then((response) => {
            if (response.data.message === 'success') {
              toastr.options = {
                positionClass: 'toast-bottom-right',
              };
              toastr.success('Variation Updated Successfully');
              self.form.variations = response.data.data.variations;

              $('#modal-block-update-variations').modal('toggle');
              $('div').removeClass('modal-backdrop');
            }
          });
      } catch (error) {
        if (error.response.status === 422) {
          this.updateVariation.errors.record(error.response.data);
        }
      }
    },
    async submitForm() {
      this.$v.$touch();

      //   const self = this;
      if (!this.$v.$invalid) {
        try {
          await this.$axios
            .put(`admin/products/${this.form.id}`, this.form, {
              // onUploadProgress: ({ total, loaded }) => {
              //   this.value = (loaded / total).toFixed(2) * 100;
              // },
            })
            .then(function (response) {
              if (response.data.message === 'success') {
                // this.isUploading = false;
                toastr.options = {
                  positionClass: 'toast-bottom-right',
                };
                toastr.success('Product Updated Successfully');
              }
            });
        } catch (error) {
          if (error.response.status === 422) {
            this.form.errors.record(error.response.data);
          }
        }
      }
    },
  },
};
</script>

<style>
.multiple-upload .upload-container {
  height: 100px !important;
  width: 100px !important;
  border: 2px dashed #ccc;
  border-radius: 5px !important;
}

.multiple-upload .upload-container :hover {
  background-color: #ccc !important;
}

.multiple-upload .input-uploader {
  opacity: 0;
  position: absolute;
  width: 100px !important;
  height: 100px !important;
  cursor: pointer;
}

.multiple-upload .uploader-icon {
  width: 35px !important;
  height: 35px !important;
}

.single-upload .upload-container {
  height: 100px !important;
  width: 100px !important;
  border: 2px dashed #ccc;
  border-radius: 5px !important;
}

.single-upload .upload-container :hover {
  background-color: #ccc !important;
}

.single-upload .input-uploader {
  opacity: 0;
  position: absolute;
  width: 100px !important;
  height: 100px !important;
}

.single-upload .uploader-icon {
  width: 35px !important;
  height: 35px !important;
}

.dropzone-upload .upload-container {
  height: 200px !important;
  border: 2px dashed #ccc !important;
  border-radius: 10px !important;
}

.dropzone-upload .upload-container :hover {
  background-color: #ccc !important;
}

.dropzone-upload .input-uploader {
  position: absolute;
  height: 200px !important;
  width: 93% !important;
  border-radius: 10px !important;
  opacity: 0 !important;
  border: 2px solid balck;
}

.dropzone-upload .uploader-icon {
  width: 100px !important;
  height: 100px !important;
}
</style>
