<template>
  <main id="main-container">
    <!-- Page Content -->
    <div class="content">
      <!-- Info -->
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">ADD NEW PRODUCT</h3>
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
                    <!--                     <span
                      class="text-danger"
                      v-if="!$v.form.price.numeric && $v.form.price.$dirty"
                      >The price field must be a number.</span
                    > -->
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
                    <option value="slim">Slim</option>
                    <option value="regular">Regular</option>
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
                    Add Product
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- END Info -->

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
                      v-if="uploadedMainImage"
                      class="img-fluid options-item"
                      :src="uploadedMainImage"
                      alt="Product Main image"
                    />
                    <div class="options-overlay bg-black-75">
                      <div class="options-overlay-content">
                        <a
                          class="btn btn-sm btn-light"
                          href="#"
                          @click.prevent="removeMainImage()"
                        >
                          <i class="fa fa-times text-danger mr-1" /> Delete
                        </a>
                      </div>
                    </div>
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
                  v-for="(img, key) in uploadedImages"
                  :key="key"
                  class="col-3 animated fadeIn"
                >
                  <div
                    class="options-container"
                    style="max-width: 350px; max-height: 400px"
                  >
                    <img
                      class="img-fluid options-item"
                      :src="img"
                      alt="Responsive image"
                    />
                    <div class="options-overlay bg-black-75">
                      <div class="options-overlay-content">
                        <a
                          class="btn btn-sm btn-light"
                          href="#"
                          @click.prevent="removeImage(key)"
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
      <!-- END Media -->
    </div>
    <!-- END Page Content -->
  </main>
</template>
<script>
import { required, maxLength, integer } from 'vuelidate/lib/validators';
import Form from '@/static/js/Form.js';
import VueAutonumeric from '@/node_modules/vue-autonumeric/src/components/VueAutonumeric.vue';

export default {
  components: {
    VueAutonumeric,
  },
  layout: 'admin',
  middleware: ['auth-admin'],
  async asyncData({ $axios, params, app }) {
    const brands = await $axios.$get('admin/brands');
    return {
      brands: brands.data,
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
      imageLimit: 15,
      imageSizeLimit: 2 * 1024 * 1024, // 2 MB
      isUploading: false,
      uploadedMainImage: null,
      uploadedImages: [],
      title: 'Add New Product',
      sizesList: ['S', 'M', 'L', 'XL', 'XXL'],
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
    removeMainImage() {
      this.uploadedMainImage = null;
    },
    removeImage(key) {
      this.uploadedImages.splice(key, 1);
      this.files.splice(key, 1);
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
        this.$refs.imageUploader.files.length + this.files.length >
          this.imageLimit
      ) {
        return false;
      }
      return true;
    },
    mainImageInserted() {
      const self = this;
      if (!this.isFileTypeValid(this.$refs.mainImageUploader.files)) {
        toastr.error('Please select only images');
        return;
      }
      if (!this.isImageSizeValid(this.$refs.mainImageUploader.files)) {
        toastr.error('Image size cannot be more than 2 MB');
        return;
      }
      this.form.main_image = this.$refs.mainImageUploader.files[0];
      if (this.form.main_image) {
        const reader = new FileReader();
        reader.readAsDataURL(this.form.main_image);
        reader.onload = function (e) {
          self.uploadedMainImage = e.target.result;
        };
      }
    },
    imagesInserted() {
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
      const self = this;
      Array.from(this.$refs.imageUploader.files).forEach(function (
        file,
        index
      ) {
        self.files.push(file);
      });
      if (this.files) {
        for (let i = 0; i < this.files.length; i++) {
          const file = this.files[i];
          const reader = new FileReader();
          reader.readAsDataURL(file);
          self.uploadedImages = [];
          reader.onload = function (e) {
            self.uploadedImages.push(e.target.result);
          };
        }
      }
    },
    async submitForm() {
      this.$v.$touch();

      const self = this;
      if (!this.$v.$invalid) {
        try {
          const formData = new FormData();
          if (this.files.length) {
            _.forEach(this.files, (file) => {
              formData.append('image_gallery[]', file);
            });
          }
          for (const key of Object.keys(this.form)) {
            formData.append(key, this.form[key]);
          }

          if (this.files.length) {
            this.isUploading = true;
          }
          await this.$axios
            .post('admin/products', formData, {
              headers: {
                'Content-Type': 'multipart/form-data',
              },
              onUploadProgress: ({ total, loaded }) => {
                this.value = (loaded / total).toFixed(2) * 100;
              },
            })
            .then(function (response) {
              if (response.data.message === 'success') {
                // this.isUploading = false;
                toastr.options = {
                  positionClass: 'toast-bottom-right',
                };
                toastr.success('Product successfully added');
                self.$router.push(
                  '/admin/products/edit-product/' + response.data.data.slug
                );
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
