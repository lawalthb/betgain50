<div x-data="modal" id="referral">


    <a href="javascript:;" title="Refer" class="relative block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60" @click="toggle">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0002 1.25C9.37683 1.25 7.25018 3.37665 7.25018 6C7.25018 8.62335 9.37683 10.75 12.0002 10.75C14.6235 10.75 16.7502 8.62335 16.7502 6C16.7502 3.37665 14.6235 1.25 12.0002 1.25ZM8.75018 6C8.75018 4.20507 10.2053 2.75 12.0002 2.75C13.7951 2.75 15.2502 4.20507 15.2502 6C15.2502 7.79493 13.7951 9.25 12.0002 9.25C10.2053 9.25 8.75018 7.79493 8.75018 6Z" fill="currentColor" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.72778 5.8181C2.62732 5.41625 2.22012 5.17193 1.81828 5.27239C1.41643 5.37285 1.17211 5.78006 1.27257 6.1819L1.65454 7.70977C2.3593 10.5288 4.49604 12.7496 7.25018 13.5787L7.25018 18.052C7.25015 18.9505 7.25012 19.6997 7.33009 20.2945C7.41449 20.9223 7.60016 21.4891 8.05563 21.9445C8.5111 22.4 9.0779 22.5857 9.7057 22.6701C10.3005 22.7501 11.0497 22.75 11.9482 22.75H12.0522C12.9507 22.75 13.6999 22.7501 14.2947 22.6701C14.9225 22.5857 15.4892 22.4 15.9447 21.9445C16.4002 21.4891 16.5859 20.9223 16.6703 20.2945C16.7502 19.6997 16.7502 18.9505 16.7502 18.052L16.7502 13.859C17.7313 14.1515 18.4808 15.0039 18.6058 16.0671L19.2553 21.5876C19.3037 21.999 19.6764 22.2933 20.0878 22.2449C20.4992 22.1965 20.7934 21.8237 20.745 21.4124L20.0956 15.8918C19.8512 13.8151 18.0912 12.25 16.0002 12.25H8.0847C5.64125 11.6764 3.71957 9.78523 3.10975 7.34596L2.72778 5.8181ZM8.75018 18V13.75H15.2502V18C15.2502 18.964 15.2486 19.6116 15.1836 20.0946C15.1216 20.5561 15.0144 20.7536 14.8841 20.8839C14.7537 21.0142 14.5562 21.1214 14.0948 21.1835C13.6117 21.2484 12.9642 21.25 12.0002 21.25C11.0362 21.25 10.3886 21.2484 9.90557 21.1835C9.44411 21.1214 9.24661 21.0142 9.11629 20.8839C8.98598 20.7536 8.87875 20.5561 8.81671 20.0946C8.75177 19.6116 8.75018 18.964 8.75018 18Z" fill="currentColor" />
        </svg>

    </a>
    <!-- modal -->
    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
        <div class="flex items-start justify-center min-h-screen px-5 mt-5" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden my-2 w-full max-w-lg">
                <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                    <div class="font-bold text-lg">BetGain Refferal Program</div>



                </div>
                <div class="p-2">
                    <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                        Refer Link:
                        <br />
                        <span id="referral_link"></span>
                        <span id="copyBtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 1.25H10.9436C9.10583 1.24998 7.65019 1.24997 6.51098 1.40314C5.33856 1.56076 4.38961 1.89288 3.64124 2.64124C2.89288 3.38961 2.56076 4.33856 2.40314 5.51098C2.24997 6.65019 2.24998 8.10582 2.25 9.94357V16C2.25 17.8722 3.62205 19.424 5.41551 19.7047C5.55348 20.4687 5.81753 21.1208 6.34835 21.6517C6.95027 22.2536 7.70814 22.5125 8.60825 22.6335C9.47522 22.75 10.5775 22.75 11.9451 22.75H15.0549C16.4225 22.75 17.5248 22.75 18.3918 22.6335C19.2919 22.5125 20.0497 22.2536 20.6517 21.6517C21.2536 21.0497 21.5125 20.2919 21.6335 19.3918C21.75 18.5248 21.75 17.4225 21.75 16.0549V10.9451C21.75 9.57754 21.75 8.47522 21.6335 7.60825C21.5125 6.70814 21.2536 5.95027 20.6517 5.34835C20.1208 4.81753 19.4687 4.55348 18.7047 4.41551C18.424 2.62205 16.8722 1.25 15 1.25ZM17.1293 4.27117C16.8265 3.38623 15.9876 2.75 15 2.75H11C9.09318 2.75 7.73851 2.75159 6.71085 2.88976C5.70476 3.02502 5.12511 3.27869 4.7019 3.7019C4.27869 4.12511 4.02502 4.70476 3.88976 5.71085C3.75159 6.73851 3.75 8.09318 3.75 10V16C3.75 16.9876 4.38624 17.8265 5.27117 18.1293C5.24998 17.5194 5.24999 16.8297 5.25 16.0549V10.9451C5.24998 9.57754 5.24996 8.47522 5.36652 7.60825C5.48754 6.70814 5.74643 5.95027 6.34835 5.34835C6.95027 4.74643 7.70814 4.48754 8.60825 4.36652C9.47522 4.24996 10.5775 4.24998 11.9451 4.25H15.0549C15.8297 4.24999 16.5194 4.24998 17.1293 4.27117ZM7.40901 6.40901C7.68577 6.13225 8.07435 5.9518 8.80812 5.85315C9.56347 5.75159 10.5646 5.75 12 5.75H15C16.4354 5.75 17.4365 5.75159 18.1919 5.85315C18.9257 5.9518 19.3142 6.13225 19.591 6.40901C19.8678 6.68577 20.0482 7.07435 20.1469 7.80812C20.2484 8.56347 20.25 9.56458 20.25 11V16C20.25 17.4354 20.2484 18.4365 20.1469 19.1919C20.0482 19.9257 19.8678 20.3142 19.591 20.591C19.3142 20.8678 18.9257 21.0482 18.1919 21.1469C17.4365 21.2484 16.4354 21.25 15 21.25H12C10.5646 21.25 9.56347 21.2484 8.80812 21.1469C8.07435 21.0482 7.68577 20.8678 7.40901 20.591C7.13225 20.3142 6.9518 19.9257 6.85315 19.1919C6.75159 18.4365 6.75 17.4354 6.75 16V11C6.75 9.56458 6.75159 8.56347 6.85315 7.80812C6.9518 7.07435 7.13225 6.68577 7.40901 6.40901Z" fill="white" />
                            </svg>
                        </span>

                        <br />

                        My refers list
                        <br />
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyButton = document.getElementById('copyBtn');
        const contentToCopy = document.getElementById('referral_link');

        copyButton.addEventListener('click', function() {
            const content = contentToCopy.innerText || contentToCopy.textContent;

            navigator.clipboard.writeText(content).then(function() {
                alert('Referral link copied to clipboard!');
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
            });
        });
    });
</script>

</div>