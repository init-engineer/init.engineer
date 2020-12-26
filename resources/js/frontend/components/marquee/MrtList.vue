<template>
  <marquee-text :repeat="1" :duration="60">
    <h1
      class="color-color-primary"
    >動物園、萬芳社區、萬芳醫院、辛亥、麟光、六張犁、科技大樓、大安、忠孝復興、南京復興、中山國中、松山機場、大直、劍南路、港墘、文德、內湖、大湖公園、葫州、東湖、南港軟體園區、南港展覽館、南港、昆陽、後山埤、永春、市政府、國父紀念館、忠孝敦化、忠孝新生、善導寺、台北車站、西門、龍山寺、江子翠、新埔、板橋、府中、亞東醫院、海山、土城、永寧、頂埔、象山、一零一、信義安和、大安森林公園、東門、中正紀念堂、台大醫院、中山、雙連、民權西路、圓山、劍潭、士林、芝山、明德、石牌、唭哩岸、奇岩、北投、復興崗、忠義、關渡、竹圍、紅樹林、淡水、新店、新店區公所、七張、大坪林、景美、萬隆、公館、台電大樓、古亭、小南門、北門、松江南京、台北小巨蛋、南京三民、松山、</h1>
  </marquee-text>
</template>

<script>
import MarqueeText from "vue-marquee-text-component";

export default {
  name: "MrtList",
  components: {
    MarqueeText
  }
};
</script>
