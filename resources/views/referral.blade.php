<div x-data="modal" id="referral" >
       
        
        <a href="javascript:;" title="Refer"
                        class="relative block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
                        @click="toggle">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M12.0002 1.25C9.37683 1.25 7.25018 3.37665 7.25018 6C7.25018 8.62335 9.37683 10.75 12.0002 10.75C14.6235 10.75 16.7502 8.62335 16.7502 6C16.7502 3.37665 14.6235 1.25 12.0002 1.25ZM8.75018 6C8.75018 4.20507 10.2053 2.75 12.0002 2.75C13.7951 2.75 15.2502 4.20507 15.2502 6C15.2502 7.79493 13.7951 9.25 12.0002 9.25C10.2053 9.25 8.75018 7.79493 8.75018 6Z" fill="currentColor"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M2.72778 5.8181C2.62732 5.41625 2.22012 5.17193 1.81828 5.27239C1.41643 5.37285 1.17211 5.78006 1.27257 6.1819L1.65454 7.70977C2.3593 10.5288 4.49604 12.7496 7.25018 13.5787L7.25018 18.052C7.25015 18.9505 7.25012 19.6997 7.33009 20.2945C7.41449 20.9223 7.60016 21.4891 8.05563 21.9445C8.5111 22.4 9.0779 22.5857 9.7057 22.6701C10.3005 22.7501 11.0497 22.75 11.9482 22.75H12.0522C12.9507 22.75 13.6999 22.7501 14.2947 22.6701C14.9225 22.5857 15.4892 22.4 15.9447 21.9445C16.4002 21.4891 16.5859 20.9223 16.6703 20.2945C16.7502 19.6997 16.7502 18.9505 16.7502 18.052L16.7502 13.859C17.7313 14.1515 18.4808 15.0039 18.6058 16.0671L19.2553 21.5876C19.3037 21.999 19.6764 22.2933 20.0878 22.2449C20.4992 22.1965 20.7934 21.8237 20.745 21.4124L20.0956 15.8918C19.8512 13.8151 18.0912 12.25 16.0002 12.25H8.0847C5.64125 11.6764 3.71957 9.78523 3.10975 7.34596L2.72778 5.8181ZM8.75018 18V13.75H15.2502V18C15.2502 18.964 15.2486 19.6116 15.1836 20.0946C15.1216 20.5561 15.0144 20.7536 14.8841 20.8839C14.7537 21.0142 14.5562 21.1214 14.0948 21.1835C13.6117 21.2484 12.9642 21.25 12.0002 21.25C11.0362 21.25 10.3886 21.2484 9.90557 21.1835C9.44411 21.1214 9.24661 21.0142 9.11629 20.8839C8.98598 20.7536 8.87875 20.5561 8.81671 20.0946C8.75177 19.6116 8.75018 18.964 8.75018 18Z" fill="currentColor"/>
</svg>

                    </a>
        <!-- modal -->
        <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'" >
            <div class="flex items-start justify-center min-h-screen px-5 mt-5" @click.self="open = false">
                <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden my-2 w-full max-w-lg">
                    <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                        <div class="font-bold text-lg">Affiliates Program correct</div>
                     
                          
                       
                    </div>
                    <div class="p-2">
                        <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                        Affiliates Program Affiliates Program Affiliates Program Affiliates Program correct
                        </div>
                        <div class="flex justify-end items-center mt-8">
                            <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- script -->
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("modal", (initialOpenState = false) => ({
                open: initialOpenState,

                toggle() {
                    this.open = !this.open;
                },
            }));
        });
    </script>
                   
                   
                </div>