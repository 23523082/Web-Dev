function toggleMenu() {
  const menuBar = document.getElementById("menuBar");
  const overlay = document.getElementById("overlay");

  if (menuBar.classList.contains("hidden")) {
    // Show menu bar and overlay
    menuBar.classList.remove("hidden");
    menuBar.classList.add("show");
    overlay.classList.remove("hidden");
    overlay.classList.add("show");
  } else {
    // Hide menu bar and overlay
    menuBar.classList.remove("show");
    menuBar.classList.add("hidden");
    overlay.classList.remove("show");
    overlay.classList.add("hidden");
  }
}

// Ambil elemen input dan elemen readonly-name
const firstNameInput = document.getElementById("first-name");
const lastNameInput = document.getElementById("last-name");
const titleDropdown = document.getElementById("title-dropdown");
const readonlyName = document.getElementById("readonly-name");

// Fungsi untuk memperbarui readonly-name
function updateReadonlyName() {
  const title = titleDropdown.value; // Ambil nilai dropdown title
  const firstName = firstNameInput.value.trim(); // Ambil nilai first name
  const lastName = lastNameInput.value.trim(); // Ambil nilai last name

  // Update elemen readonly-name
  readonlyName.textContent = ` ${firstName} ${lastName}`;
}

// Tambahkan event listener ke input first-name dan last-name
firstNameInput.addEventListener("input", updateReadonlyName);
lastNameInput.addEventListener("input", updateReadonlyName);

// Tambahkan event listener ke dropdown title
titleDropdown.addEventListener("change", updateReadonlyName);

// Inisialisasi readonly-name saat halaman dimuat
document.addEventListener("DOMContentLoaded", updateReadonlyName);

// Ambil elemen country dan prefix
const countrySelect = document.getElementById("country");
const prefixSelect = document.getElementById("prefix");

// Fungsi untuk memperbarui opsi prefix
function updatePrefixOptions() {
  const selectedCountry = countrySelect.value; // Ambil negara yang dipilih
  prefixSelect.innerHTML = ""; // Hapus semua opsi di prefix

  if (countryPrefixMap[selectedCountry]) {
    // Jika ada prefix untuk negara yang dipilih
    const option = document.createElement("option");
    option.value = countryPrefixMap[selectedCountry];
    option.textContent = countryPrefixMap[selectedCountry];
    prefixSelect.appendChild(option);
  } else {
    // Jika tidak ada negara yang dipilih atau tidak ditemukan prefix
    const defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.textContent = "Select prefix...";
    prefixSelect.appendChild(defaultOption);
  }
}

// Data hubungan country dan prefix
const countryPrefixMap = {
  Indonesia: "+62",
  Malaysia: "+60",
  Singapore: "+65",
  Thailand: "+66",
  Vietnam: "+84",
  Philippines: "+63",
  Myanmar: "+95",
  Cambodia: "+855",
  Laos: "+856",
  Brunei: "+673",
  China: "+86",
  Japan: "+81",
  "United States": "+1",
};

// Tambahkan event listener untuk perubahan di country
countrySelect.addEventListener("change", updatePrefixOptions);

// Inisialisasi awal (jika ada negara yang dipilih)
document.addEventListener("DOMContentLoaded", updatePrefixOptions);

const citySelect = document.getElementById("city");

// Fungsi untuk memperbarui opsi city
function updateCityOptions() {
  const selectedCountry = countrySelect.value; // Ambil negara yang dipilih
  citySelect.innerHTML = ""; // Hapus semua opsi di city

  if (countryCityMap[selectedCountry]) {
    // Jika ada data kota untuk negara yang dipilih
    countryCityMap[selectedCountry].forEach((city) => {
      const option = document.createElement("option");
      option.value = city;
      option.textContent = city;
      citySelect.appendChild(option);
    });
  } else {
    // Jika tidak ada negara yang dipilih atau tidak ditemukan kota
    const defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.textContent = "Select a city";
    citySelect.appendChild(defaultOption);
  }
}

// Data hubungan country dan city
const countryCityMap = {
  Indonesia: [
    "Jakarta",
    "Bandung",
    "Surabaya",
    "Medan",
    "Yogyakarta",
    "Semarang",
    "Palembang",
    "Makassar",
    "Denpasar",
    "Batam",
    "Pekanbaru",
    "Malang",
    "Samarinda",
    "Banjarmasin",
    "Padang",
  ],
  Malaysia: [
    "Kuala Lumpur",
    "Penang",
    "Johor Bahru",
    "Malacca",
    "Kota Kinabalu",
    "Shah Alam",
    "Petaling Jaya",
    "Ipoh",
    "Kuching",
    "Miri",
    "George Town",
    "Alor Setar",
    "Seremban",
    "Kuantan",
    "Sandakan",
  ],
  Singapore: ["Singapore"],
  Thailand: [
    "Bangkok",
    "Chiang Mai",
    "Phuket",
    "Pattaya",
    "Hua Hin",
    "Chiang Rai",
    "Nakhon Ratchasima",
    "Krabi",
    "Koh Samui",
    "Udon Thani",
    "Hat Yai",
    "Surat Thani",
    "Khon Kaen",
  ],
  Vietnam: [
    "Hanoi",
    "Ho Chi Minh City",
    "Da Nang",
    "Hai Phong",
    "Nha Trang",
    "Hue",
    "Can Tho",
    "Vung Tau",
    "Phan Thiet",
    "Quy Nhon",
    "Da Lat",
    "Buon Ma Thuot",
  ],
  Philippines: [
    "Manila",
    "Cebu",
    "Davao",
    "Quezon City",
    "Makati",
    "Pasig",
    "Caloocan",
    "Taguig",
    "Zamboanga",
    "Cagayan de Oro",
    "Baguio",
    "Iloilo City",
    "Bacolod",
  ],
  Myanmar: [
    "Yangon",
    "Mandalay",
    "Naypyidaw",
    "Bago",
    "Taunggyi",
    "Monywa",
    "Sittwe",
    "Pathein",
    "Pyin Oo Lwin",
    "Hpa-An",
    "Mawlamyine",
  ],
  Cambodia: [
    "Phnom Penh",
    "Siem Reap",
    "Sihanoukville",
    "Battambang",
    "Kampot",
    "Kampong Cham",
    "Kep",
    "Pursat",
    "Koh Kong",
    "Kampong Speu",
    "Preah Sihanouk",
  ],
  Laos: [
    "Vientiane",
    "Luang Prabang",
    "Pakse",
    "Savannakhet",
    "Thakhek",
    "Phonsavan",
    "Champasak",
    "Vang Vieng",
    "Muang Xay",
    "Houayxay",
    "Xam Neua",
  ],
  Brunei: [
    "Bandar Seri Begawan",
    "Kuala Belait",
    "Tutong",
    "Seria",
    "Bangar",
    "Labi",
    "Muara",
  ],
  China: [
    "Beijing",
    "Shanghai",
    "Guangzhou",
    "Shenzhen",
    "Chengdu",
    "Chongqing",
    "Xi'an",
    "Hangzhou",
    "Wuhan",
    "Nanjing",
    "Tianjin",
    "Shenyang",
    "Qingdao",
    "Dongguan",
    "Harbin",
    "Changsha",
    "Dalian",
  ],
  Japan: [
    "Tokyo",
    "Osaka",
    "Kyoto",
    "Nagoya",
    "Yokohama",
    "Fukuoka",
    "Sapporo",
    "Hiroshima",
    "Kobe",
    "Sendai",
    "Kumamoto",
    "Nagasaki",
    "Shizuoka",
    "Nara",
    "Okinawa",
    "Niigata",
  ],
  United_States: [
    "New York",
    "Los Angeles",
    "Chicago",
    "Houston",
    "Miami",
    "San Francisco",
    "Las Vegas",
    "Boston",
    "Seattle",
    "Dallas",
    "Atlanta",
    "Washington D.C.",
    "Denver",
    "Phoenix",
    "Orlando",
  ],
};

// Tambahkan event listener untuk perubahan di country
countrySelect.addEventListener("change", updateCityOptions);

// Inisialisasi awal (jika ada negara yang dipilih)
document.addEventListener("DOMContentLoaded", updateCityOptions);
