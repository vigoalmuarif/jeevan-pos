import './bootstrap';
import  'preline';
import '../../vendor/masmerise/livewire-toaster/resources/js';
import Swal from 'sweetalert2'
import * as FloatingUI from '@floating-ui/dom';

window.FloatingUIDOM = FloatingUI;
window.Swal = Swal

document.addEventListener("DOMContentLoaded", function () {
    HSStaticMethods.autoInit(); // Inisialisasi saat halaman pertama kali dimuat
    
    document.addEventListener("livewire:navigating", () => {
        HSStaticMethods.autoInit();
    });
    
    document.addEventListener("livewire:navigated", () => {
        HSStaticMethods.autoInit();
    });
    // Livewire.hook("morph", ({ el, component }) => {
    //     // Sebelum Livewire memperbarui DOM
    // });

    if (typeof Livewire !== 'undefined') {
        Livewire.hook("morphed", ({ el, component }) => {
            // Setelah Livewire selesai memperbarui DOM, jalankan kembali HSStaticMethods.autoInit()
            HSStaticMethods.autoInit();
        });
    }
});
