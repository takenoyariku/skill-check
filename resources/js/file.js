//アップロードファイルサイズ上限
const fileLimit = 1024 * 1024 * 2;

//画像アップロードinput要素
const fileUpload = document.getElementById('image');

fileUpload.addEventListener('change', () => {
  const files = fileUpload.files;
  if(files[0].size >= fileLimit){
    alert('2MBを超えた画像はアップロードできません');
    fileUpload.value = "";
    return;
  }
});