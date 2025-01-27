<template>
    <Transition name="modal">
        <div
            tabindex="-1"
            class="modal-mask hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center md:inset-0 h-[calc(100%-1rem)] max-h-full"
        >
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t"
                    >
                        <h3 class="text-lg font-semibold text-gray-900">
                            Create New Product
                        </h3>
                        <button
                            type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            @click="closeModal"
                        >
                            <svg
                                class="w-3 h-3"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 14 14"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                                />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form
                        class="p-4 md:p-5"
                        @submit.prevent="saveProduct"
                        method="POST"
                    >
                        <div
                            class="grid gap-4 mb-4 grid-cols-2 grid-cols-custom"
                        >
                            <div class="col-span-1">
                                <label
                                    for="name"
                                    class="block mb-2 text-sm font-medium text-left text-gray-900"
                                    >Name</label
                                >
                                <input
                                    type="text"
                                    v-model="formData.name"
                                    name="name"
                                    id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Type product name"
                                    required
                                />
                            </div>

                            <div class="col-span-1 row-span-4">
                                <label
                                    for="product-image"
                                    class="block mb-2 text-sm font-medium text-left text-gray-900"
                                    >Product Image</label
                                >
                                <div
                                    class="rounded-lg border border-dashed border-gray-900/25 px-4 py-4"
                                >
                                    <div
                                        class="block flex justify-center mb-2 text-sm text-center leading-6 text-gray-600"
                                    >
                                        <label
                                            for="file-upload"
                                            class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500"
                                        >
                                            <button
                                                type="button"
                                                @click="selectImage"
                                            >
                                                {{ buttonText }}
                                            </button>
                                            <input
                                                type="file"
                                                name="file-upload"
                                                id="file-upload"
                                                accept="image/png, image/jpeg, image/jpg"
                                                ref="fileInput"
                                                class="sr-only"
                                                @change="handleImageUpload"
                                            />
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>

                                    <div v-if="uploadedImageURL">
                                        <img
                                            :src="uploadedImageURL"
                                            alt="Uploaded Image"
                                            width="230"
                                            height="300"
                                            class="max-w-full max-h-full rounded-md m-auto"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-1">
                                <label
                                    for="category"
                                    class="block mb-2 text-sm font-medium text-left text-gray-900"
                                    >Category</label
                                >
                                <select
                                    v-model="formData.category"
                                    id="category"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                    required
                                >
                                    <option
                                        v-for="category in categories"
                                        :key="category.id"
                                        :value="category.id"
                                    >
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-span-1">
                                <label
                                    for="price"
                                    class="block mb-2 text-sm font-medium text-left text-gray-900"
                                    >Price</label
                                >
                                <input
                                    type="text"
                                    v-model="formData.price"
                                    name="price"
                                    id="price"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    required
                                />
                                <div
                                    v-if="invalidPrice"
                                    class="text-xs pt-2 text-red-600"
                                >
                                    Please enter a valid number
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label
                                    for="description"
                                    class="block mb-2 text-sm font-medium text-left text-gray-900"
                                    >Product Description</label
                                >
                                <textarea
                                    v-model="formData.description"
                                    id="description"
                                    rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Write product description here"
                                ></textarea>
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="text-white mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center"
                        >
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script>
import axios from "axios";

export default {
    name: "ProductModal",
    props: {
        showModal: Boolean, // Ajoutez une prop pour contrôler l'état du modal
        categories: Array, // Prop to pass categories data
    },
    data() {
        return {
            buttonText: "Upload Image",
            uploadedImageURL: null, // Add a data property to store the uploaded image
            imageFile: null, // Stocker le fichier image
            invalidPrice: false,
            formData: {
                name: "",
                category: {},
                description: "",
                price: 0,
            },
        };
    },

    methods: {
        closeModal() {
            this.$emit("close"); // Émet un événement pour fermer le modal
        },
        selectImage() {
            this.$refs.fileInput.click();
        },
        handleImageUpload(event) {
            const file = event.target.files[0];
            this.imageFile = file; // Enregistrer le fichier pour l'envoi
            this.uploadedImageURL = URL.createObjectURL(file);
            this.buttonText = "Change Image";
        },

        async saveProduct() {
            // Convert the price to a number
            const price = parseFloat(this.formData.price);

            // Check if the price is a valid number
            if (isNaN(price) || price <= 0) {
                // Notify the user that the price is invalid
                this.invalidPrice = true;
                this.invalidQte = false;
                return;
            }
            this.invalidPrice = false;

            // Create a new product object using formData
            const newProduct = {
                name: this.formData.name,
                category_id: this.formData.category,
                description: this.formData.description,
                price: price,
                image: this.imageFile,
            };
            console.log("New Product:", newProduct);

            try {
                await axios.post(
                    `http://127.0.0.1:8000/api/products`,
                    newProduct,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                );
                console.log("Product saved successfully");

                // Emit an event to save the new product
                this.$emit("save", newProduct);
                this.formData = {}; // Reset form
                this.closeModal();
            } catch (error) {
                // Handle error response
                if (error.response && error.response.status === 400) {
                    console.error("Error Product already exists:", error);
                } else {
                    // Other errors
                    console.error("Error creating product:", error);
                }
            }
        },
    },
};
</script>
<style scoped>
@import "../../css/styleModal.css";

.modal-mask {
    background-color: rgb(0, 0, 0, 0.5);
}
.grid-cols-custom {
    grid-template-columns: 1fr 1fr;
}
</style>
