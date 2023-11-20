use servidor;
select * from Publicacion;
select * from Imagen i join Publicacion p on p.pubId=i.pubId join Tren t on p.trenId=t.trenId join Usuario u on u.email=p.email  join tipoTren tt on tt.tipoTren = t.tipoTren;
select max(i.num) from Imagen i where sesion="santi";
