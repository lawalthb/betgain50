<div x-data="modal" id="faq" >


       <a href="javascript:;" title="FAQ"
                       class="relative block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
                       @click="toggle">
                       <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.125 8.875C10.125 7.83947 10.9645 7 12 7C13.0355 7 13.875 7.83947 13.875 8.875C13.875 9.56245 13.505 10.1635 12.9534 10.4899C12.478 10.7711 12 11.1977 12 11.75V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
<circle cx="12" cy="16" r="1" fill="currentColor"/>
<path d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
</svg>
                   </a>

<!-- modal -->
<div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
            <div class="flex items-start justify-center min-h-screen px-5 mt-6" @click.self="open = false">
                <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden my-2 w-full max-w-lg">
                    <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                        <div class="font-bold text-lg">F.A.Q </div>



                    </div>
                    <div class="p-2">
                        <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                        BASICS <br />

WHAT IS BetGain?<br />
BetGain is a thrilling social online game. It's a real time, simple, and exciting game where you can securely play for fun or to win a fortune.
Each round of the game, you have the opportunity to place a bet before the round starts. Once the round begins, a lucky multiplier starts at 1x and begins climbing higher and higher.
At any moment, you can click Cashout to lock in the current multiplier which awards you with your multiplied bet.
The longer you stay in the game before cashing out, the higher the multiplier gets. But beware! Every tick of the game has a chance of busting. If you do not cash out before the bust, you lose your bet.
Every round is a fight between risk and reward. Do you cash out at 1.1x for a conservative win? Or do you stay in the game to hunt the high 1000x multipliers?
BetGain is provably fair  and has one of the lowest house edges in the market, of only 1%.
HOW DO I PLAY BetGain?<br />
First you need to have a positive balance, by depositing money through MPESA to your account or receiving a tip from someone in the community.
Next, select the amount to bet and a cash out multiplier. Place your bet. Watch the multiplier increase from 1x upwards! You can cash out before your set up cash out limit, pressing the Cash Out button. Get your bet multiplied by that multiplier. But be careful because the game can bust at any time, and you'll get nothing!
IS BetGain A FAIR GAME?<br />
Absolutely! And we can prove it.
There are already 3rd party open source scripts to verify and calculate the game results. Check out this handy tool that one of our players generously made.
Learn more about our  provably fair system
HOW HIGH CAN THE GAME GO?<br />
We currently a limit of upto 3000X

HOW TO REGISTER ON BetGain?<br />
Open your your web browser and type in play.BetGain.com
On the BetGain page click on Register
Enter your number and chosen password of six or more characters then select Join BetGain
HOW TO DEPOSIT ON BetGain?<br />
Go to M-PESA on your phone
Select Pay Bill option
Enter Business no. 547717 (BetGain)
Enter Account no. Your account number is unique and can be found on the deposit page
Enter the Amount
Enter your M-PESA PIN and Send
NOTE:
Minimum deposit amount is KES 50 You can ONLY deposit using the same phone number you use to login. You cannot deposit while you have an active bonus
HOW TO PLAY BetGain AFFILIATE PROGRAM?<br />
Register/log in on play.BetGain.com
When the BetGain page appears click on affiliate program
Copy your link and share to earn 30 % commission on revenues made!
HOW DO I CONTACT BetGain CUSTOMER CARE?
You can contact BetGain customer care through the customer care number 0743999333. The customer care line is active 24/7

HOW DO I WITHDRAW FROM BetGain?<br />
Login to your account on play.BetGain.com
Select Cashier top left
Select Withdrawal
Enter the amount you wish to withdraw (minimum 100/=)
Click Request Withdrawal
HOW DO I RESET MY PASSWORD
Visit play.BetGain.com and click on log in
Click on forgot password to reset your password
CAN I BE REFUNDED ?<br />
Once you play and loose you cannot be refunded. Please refer to the terms and conditions

HOW DOES BetGain CASHOUT WORK?<br />
The Cash Out feature allows you to take an early payout on your bets before they are settled, meaning one is able to get money back before the event is over and your bet is ultimately resulted.

Note: Any stake amount can qualify for a cash out.
HOW DO I VERIFY MY PENDING DEPOSIT?<br />
Click on deposit and scroll down to verify your deposit

Note: We automatically verify all Mpesa transactions and you may never have to use this step. ONLY use this if your deposit is delayed for more than a minute.
AFFILIATE PROGRAM
WHAT IS BetGain AFFILIATE PROGRAM
BetGain Affiliates is a program where we give you the opportunity to earn money every month simply by giving us the chance to welcome more players through our virtual doors.

HOW MUCH DOES IT COST TO JOIN?<br />
Absolutely nothing. It's 100% free.

CAN I STILL BENEFIT IF I DON'T HAVE A WEBSITE?
Of course you can. We can give you all the marketing tools you will need to promote BetGain offline, on social media or by email.

HOW MUCH DO I EARN?<br />
As part of our affiliate network, you will be paid in a revenue share based model. You earn a 30% commission on revenues made.

WHAT IS NEGATIVE REVENUE?<br />
Negative commission happens when an affiliate’s players generate negative revenue for BetGain. The house periodically absorbs all negative commissions and allows an affiliate to earn positive commissions on earnings from the subsequent games without having to “pay back” the sportsbook’s loss.

Note: Negative commissions will NEVER impact your balance.
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
