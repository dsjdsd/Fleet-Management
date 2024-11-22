        <!-- Jquery Core Js --> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
        <script src="{{ asset('dashboard-assets/customfiles/custom.js') }}"></script>
        <script src="{{ asset('dashboard-assets/bundles/libscripts.bundle.js') }}"></script>
        <script src="{{ asset('dashboard-assets/bundles/vendorscripts.bundle.js') }}"></script>

        <script src="{{ asset('dashboard-assets/bundles/jvectormap.bundle.js') }}"></script>
        <script src="{{ asset('dashboard-assets/bundles/sparkline.bundle.js') }}"></script>
        <script src="{{ asset('dashboard-assets/bundles/c3.bundle.js') }}"></script>

        <script src="{{ asset('dashboard-assets/bundles/mainscripts.bundle.js') }}"></script>
        <script src="{{ asset('dashboard-assets/js/pages/index.js') }}"></script>
        <script>
            new DataTable('#district-list');
        </script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('dashboard-assets/bundles/c3.bundle.js')}}"></script>
        <script src="{{ asset('dashboard-assets/js/pages/charts/c3.js') }}"></script>
        <script src="{{ asset('dashboard-assets/plugins/dropify/js/dropify.min.js')}}"></script>
        <script src="{{ asset('dashboard-assets/js/pages/forms/dropify.js')}}"></script>

        <script src="{{ asset('dashboard-assets/plugins/select2/select2.min.js')}}"></script>
        <!-- <script src="{{ asset('dashboard-assets/js/pages/forms/advanced-form-elements.js')}}"></script>  -->



        <script src="{{ asset('dashboard-assets/js/pages/tables/jquery-datatable.js')}}"></script>
        <script src="https://cdn.tiny.cloud/1/84uc1jn9cygw1awh8pz4e6t9uyrhi4s2bn5yhdvozbiiupqw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#description',
                branding: false,
            });
        </script>
        <script>
            @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;
                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;
                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;
                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
            @endif
        </script>
    <div class="footer">
    <div class="copyright text-center text-dark">
        &copy;
        <script>document.write(new Date().getFullYear())</script>,
        <span>Developed By<a href="https://softgentech.com/" target="_blank" class="text-danger"> Softgen Technologies Pvt Ltd</a> for any query please contact at 8188886786 (Monday to Friday 10 AM to 7 PM) </span>
    </div>
    </body>
</html>