<template>
  <div>
    <h2 class="text-center">Barang List</h2>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama Barang</th>
          <th>Image</th>
          <th>Harga</th>
          <th>Keterangan</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="barang in barangs" :key="barang.id">
          <td>{{ barang.id }}</td>
          <td>{{ barang.nama_barang }}</td>
          <td>{{ barang.images }}</td>
          <td>{{ barang.harga }}</td>
          <td>{{ barang.keterangan }}</td>
          <td>
            <div class="btn-group" role="group">
              <router-link
                to="{name: 'edit', params: {id: product.id}}"
                class="btn btn-success"
                >Edit
              </router-link>
              <button class="btn btn-danger" @click="deleteBarang(barang.id)">
                Delete
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script>
export default {
  data() {
    return {
      barangs: [],
    };
  },
  created() {
    this.axios.get("http://localhost:8000/api/barangs/").then((response) => {
      this.barangs = response.data;
    });
  },
  methods: {
    deleteBarang(id) {
      this.axios
        .delete(`http://localhost:8000/api/barangs/${id}`)
        .then((response) => {
          let i = this.barangs.map((data) => data.id).indexOf(id);
          this.barangs.splice(i, 1);
        });
    },
  },
};
</script>
