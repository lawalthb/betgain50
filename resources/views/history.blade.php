<style>

/* Hide scrollbar for Chrome, Safari and Opera */
.table-responsive::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.table-responsive {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
</style>

<div class="panel h-full overflow-auto">
 
    <div class="flex items-center mb-5">
        <h5 class="font-semibold text-lg dark:text-white-light">History</h5>
    </div>
    <div>
        <div class="table-responsive " style="height: 400px; overflow: auto;"> 
            <table id='data-table'>
                <thead>
                    <tr>
                        <th class="ltr:rounded-l-md rtl:rounded-r-md">Users</th>
                        <th>Point</th>
                                            
                        <th>Amount</th>
                        <th>Hash</th>
                                        
                    </tr>
                </thead>
                <tbody>
                                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const getBetHistory = async () => {
        try {
            const response = await fetch('/api/history/list');
            const history = await response.json();
            const tableBody = document.querySelector('#data-table tbody');
            tableBody.innerHTML = '';

            history.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
            <td>${item.user.username}</td>
            <td>${item.bet_crash}</td>
            <td>${item.bet_amount}</td>
            <td>52a99c4f92360bb238d02e1cfdccb62aaf875d988b1f6f85a0fe34d8124bcf593</td>
            `;
            tableBody.appendChild(row);
        });
        } catch (error) {
            throw Error
        }
    }
    getBetHistory();
</script>