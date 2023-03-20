// async function request(
//   key = "33299161-c9719a65dfe469cb85eb97047",
//   q = "hotel%20rooms"
// ) {
//   try {
//     const res = await fetch(
//       `https://pixabay.com/api/?key=${key}&image_type=photo&orientation=horizontal&per_page=12&q=${q}&page=1`
//     );
//     if (!res.ok) {
//       const message = `An error has occured: ${res.status}`;
//       throw new Error(message);
//     }
//     let data;
//     res.json((data) => data).then((data) => data);
//     console.log(data);
//   } catch (err) {
//     console.error(err);
//   }
// }
// request();
