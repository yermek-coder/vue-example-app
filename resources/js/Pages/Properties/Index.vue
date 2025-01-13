<template>
    <el-container>
        <el-header>
            <h2>Property Search</h2>
        </el-header>

        <el-main>
            <el-container>
                <el-aside width="200px">
                    <el-form :model="form" labelPosition="top" class="property-form">
                        <el-form-item label="Name">
                            <el-input v-model="form.name" placeholder="Search by name" />
                        </el-form-item>
                        <el-form-item label="Bedrooms">
                            <el-input-number v-model="form.bedrooms" :min="0" />
                        </el-form-item>
                        <el-form-item label="Bathrooms">
                            <el-input-number v-model="form.bathrooms" :min="0" />
                        </el-form-item>
                        <el-form-item label="Storeys">
                            <el-input-number v-model="form.storeys" :min="0" />
                        </el-form-item>
                        <el-form-item label="Garages">
                            <el-input-number v-model="form.garages" :min="0" />
                        </el-form-item>
                        <el-form-item label="Price Range">
                            <el-slider v-model="price" :max="1000000" range></el-slider>
                        </el-form-item>
                        <el-button type="primary" @click="search" :loading="loading">Search</el-button>
                    </el-form>
                </el-aside>
                <el-container>
                    <el-main class="property-main">
                        <el-table v-loading="loading" :data="properties" border>
                            <el-table-column prop="name" label="Name" />
                            <el-table-column prop="price" label="Price">
                                <template #default="scope">
                                    ${{ scope.row.price.toLocaleString() }}
                                </template>
                            </el-table-column>
                            <el-table-column prop="bedrooms" label="Bedrooms" />
                            <el-table-column prop="bathrooms" label="Bathrooms" />
                            <el-table-column prop="storeys" label="Storeys" />
                            <el-table-column prop="garages" label="Garages" />
                        </el-table>
                    </el-main>
                </el-container>
            </el-container>
        </el-main>
    </el-container>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import propertyService from "@/services/property"
import { ElMessage } from 'element-plus'

const form = reactive({
    name: '',
    bedrooms: null,
    bathrooms: null,
    storeys: null,
    garages: null,
    price_from: null,
    price_to: null
})

const properties = ref([])
const loading = ref(false)
const searched = ref(false)

const price = computed({
    get() {
        return [form.price_from, form.price_to]
    },
    set(value) {
        form.price_from = value[0]
        form.price_to = value[1]
    }
})

const search = async () => {
    loading.value = true
    try {
        const response = await propertyService.searchProperties(form)
        properties.value = response.data
        searched.value = true
    } catch (error) {
        console.error('Search failed:', error)
        ElMessage.error(error?.message || error)
    } finally {
        loading.value = false
    }
}
</script>