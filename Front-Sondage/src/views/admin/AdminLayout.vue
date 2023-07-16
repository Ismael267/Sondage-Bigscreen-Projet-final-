<template>


    <div>
        <DashboardAdmin/>
        <RouterView />
    </div>
</template>
<script>
import DashboardAdmin from '../../components/DashboardAdmin.vue';
export default{
    name: "AdminLayout",
    components: { DashboardAdmin }
}
</script>