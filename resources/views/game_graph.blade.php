<script>
  document.addEventListener("alpine:init", () => {
    Alpine.data("sales", () => ({
      init() {
        isDark = this.$store.app.theme === "dark" ? true : false;
        isRtl = this.$store.app.rtlClass === "rtl" ? true : false;

        const revenueChart = null;
        const salesByCategory = null;
        const dailySales = null;
        const totalOrders = null;

        // revenue
        setTimeout(() => {
          this.revenueChart = new ApexCharts(this.$refs.revenueChart, this
            .revenueChartOptions)
          window.revenueChart = this.revenueChart;
          this.$refs.revenueChart.innerHTML = "";
          this.revenueChart.render()

          // sales by category
          this.salesByCategory = new ApexCharts(this.$refs.salesByCategory, this
            .salesByCategoryOptions)
          this.$refs.salesByCategory.innerHTML = "";
          this.salesByCategory.render()

          // daily sales
          this.dailySales = new ApexCharts(this.$refs.dailySales, this
            .dailySalesOptions)
          this.$refs.dailySales.innerHTML = "";
          this.dailySales.render()

          // total orders
          this.totalOrders = new ApexCharts(this.$refs.totalOrders, this
            .totalOrdersOptions)
          this.$refs.totalOrders.innerHTML = "";
          this.totalOrders.render()
        }, 300);

        this.$watch('$store.app.theme', () => {
          isDark = this.$store.app.theme === "dark" ? true : false;

          this.revenueChart.updateOptions(this.revenueChartOptions);
          this.salesByCategory.updateOptions(this.salesByCategoryOptions);
          this.dailySales.updateOptions(this.dailySalesOptions);
          this.totalOrders.updateOptions(this.totalOrdersOptions);
        });

        this.$watch('$store.app.rtlClass', () => {
          isRtl = this.$store.app.rtlClass === "rtl" ? true : false;
          this.revenueChart.updateOptions(this.revenueChartOptions);
        });


      },

      // revenue
      get revenueChartOptions() {
        return {
          series: [{
            name: 'Point',
            // data: [0, 4, 0, 0, 0, 0, 0, 0, 0]
          }],
          options: {
            responsive: true,
          },
          chart: {
            height: 200,
            type: "area",
            fontFamily: 'Nunito, sans-serif',
            zoom: {
              enabled: false
            },
            toolbar: {
              show: false
            },


          },

          dataLabels: {
            enabled: false
          },
          stroke: {
            // show: true,
            curve: 'smooth',
            width: 2,
            lineCap: 'square'
          },
          dropShadow: {
            enabled: true,
            opacity: 0.2,
            blur: 10,
            left: -7,
            top: 22
          },
          colors: isDark ? ['#2196f3', '#e7515a'] : ['#1b55e2', '#e7515a'],
          markers: {
            discrete: [{
                seriesIndex: 0,
                dataPointIndex: 6,
                fillColor: '#1b55e2',
                strokeColor: 'transparent',
                size: 7
              },
              {
                seriesIndex: 1,
                dataPointIndex: 10,
                fillColor: '#e7515a',
                strokeColor: 'transparent',
                size: 7
              },
            ],
          },
          labels: [],
          xaxis: {
            type: 'numeric',
            min: 0,
            tickAmount: 3,
            axisBorder: {
              show: false
            },
            axisTicks: {
              show: false
            },
            crosshairs: {
              show: true
            },
            labels: {
              offsetX: isRtl ? 2 : 0,
              offsetY: 5,
              style: {
                fontSize: '12px',
                cssClass: 'apexcharts-xaxis-title'
              }
            },
          },
          yaxis: {
            tickAmount: 7,
            labels: {
              formatter: (value) => {
                return value.toFixed(2) + 'x';
              },
              offsetX: isRtl ? -10 : -1,
              offsetY: 0,
              style: {
                fontSize: '12px',
                cssClass: 'apexcharts-yaxis-title'
              },
            },
            opposite: isRtl ? true : false,
          },
          grid: {
            borderColor: isDark ? '#191e3a' : '#e0e6ed',
            strokeDashArray: 5,
            xaxis: {
              lines: {
                show: true
              }
            },
            yaxis: {
              lines: {
                show: false
              }
            },
            padding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            }
          },
          legend: {
            position: 'top',
            horizontalAlign: 'right',
            fontSize: '16px',
            markers: {
              width: 10,
              height: 10,
              offsetX: -2,
            },
            itemMargin: {
              horizontal: 10,
              vertical: 5
            },
          },
          tooltip: {
            marker: {
              show: true
            },
            x: {
              show: false
            }
          },
          fill: {
            type: 'gradient',
            gradient: {
              shadeIntensity: 1,
              inverseColors: !1,
              opacityFrom: isDark ? 0.19 : 0.28,
              opacityTo: 0.05,
              stops: isDark ? [100, 100] : [45, 100],
            },
          },
        }
      },




    }));
  });
</script>