import './bootstrap';
import toastr from 'toastr';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



window.Echo.private('admin-timekeeping')
    .listen('.user.time.logged', (e) => {
        toastr.success(`🕒 ${e.user.name} vừa ${e.action} lúc ${e.time}`);
        console.log(e);
    });
