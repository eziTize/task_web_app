
<div class="row" id="upload_field">

    <div class="file-field input-field col s12">

        <div class="btn">

            <span>Upload Task Completion Proof</span>

            <input type="file" name="proof" accept=".jpeg,.jpg,.png,.doc,.docx,.pdf" id="fupload" onchange="checkextension()" required >

        </div>

        <div class="file-path-wrapper">

            <input class="file-path validate" type="text" placeholder="Select">



            {{--! Script for Error on non-jpg/jpeg/png/doc/pdf files !--}}

            <script>


            function checkextension() {

                var file = document.querySelector("#fupload");

                
                         if (/\.(jpg|jpeg|png|pdf|doc|docx)$/i.test(file.files[0].name) === false) {

                    swal("File format not supported", "Supported Formats: jpg/jpeg/png/pdf/doc/docx.");
                    document.querySelector("#fupload").value = "";

                }
           
            }

            </script>


            {{--! End Script !--}}


        </div>

    </div>

</div>
