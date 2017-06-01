<br>
<br>
Bu sayfa Markdown formatında ustalaşmak isteyenler için hızlı ve kolay bir rehber olarak tasarlanmıştır. Bu rehberi 3 dakikalık bir okuma ile bitirebilirsiniz. **telve.net**'te yazacağınız her türlü metin **[Markdown](https://en.wikipedia.org/wiki/Markdown)** formatını destekler. Ayrıca kısıtlı da olsa **[HTML](https://tr.wikipedia.org/wiki/HTML)** de desteklenmektedir.

##### İçindekiler  
- [Başlıklar](#basliklar)  
- [Vurgu](#vurgu)  
- [Listeler](#listeler)  
- [Bağlantılar](#baglantilar)  
- [Resimler](#resimler)  
- [Kod ve Sözdizimi Renklendirmesi](#kod)  
- [Tablolar](#tablolar)  
- [Alıntılar](#alintilar)  
- [Satır İçi HTML](#html)  
- [Yatay Çizgi](#yataycizgi)  
- [Satır Sonu](#satirsonu)
- [YouTube](#youtube)
- [Emojiler](#emojiler)

<br>
<br>

<a name="basliklar"/>
### Başlıklar
</a>

```no-highlight
# B1
## B2
### B3
#### B4
##### B5
###### B6

Alternatif olarak, B1 ve B2 için altı çizili tarzı da kullanabilirsiniz:

Alternatif-B1
======

Alternatif-B2
------
```

# B1
## B2
### B3
#### B4
##### B5
###### B6

Alternatif olarak, B1 ve B2 için altı çizili tarzı da kullanabilirsiniz:

Alternatif-B1
======

Alternatif-B2
------

<br>
<br>

<a name="vurgu"/>
### Vurgu
</a>

```no-highlight
Vurgu, diğer adıyla italik, *yıldız işareti* ile ya da _altçizgi_ ile

Güçlü vurgu, diğer adıyla kalın, **çift yıldız işareti** ile ya da __çift altçizgi__ ile yazılır.

Örneğin şu şekilde bir kombine vurgu yapılabilir: **kalın yazı ve _kalın ve italik yazı_**

Çift yaklaşık işareti ile yazının üzerini çizebilirsiniz. ~~Üzerini çiz.~~
```

Vurgu, diğer adıyla italik, *yıldız işareti* ile ya da _altçizgi_ ile

Güçlü vurgu, diğer adıyla kalın, **çift yıldız işareti** ile ya da __çift altçizgi__ ile yazılır.

Örneğin şu şekilde bir kombine vurgu yapılabilir: **kalın yazı ve _kalın ve italik yazı_**

Çift yaklaşık işareti ile yazının üzerini çizebilirsiniz. ~~Üzerini çiz.~~

<br>
<br>

<a name="listeler"/>
### Listeler
</a>

```no-highlight
1. İlk sıralı liste öğesi
2. Diğer bir öğe
  * Sırasız alt liste
1. Sayılar gerçekte önemsiz, bunun bir numara olması yeterli
  1. Sıralı alt liste
4. Ve bir başka öğe

   Liste öğeleri içerisinde girintili paragraf kullanabilirsiniz. Yukarıdan en az bir boş satır ve soldan en az bir boşluk bıraktığınıza emin olunuz. (burada hizalı gözükmesi amacıyla 3 boşluk kullanılmıştır, en az bir boşluk yeterlidir).

   Yeni paragrafa geçmeden satır sonu yapmak istiyorsanız, satırın sonunda 2 boşluk bırakınız.  
   Örneğin bu satırın aynı paragrafta ayrı bir satır olduğuna dikkat ediniz.  

* Sırasız liste yapmak için yıldız işareti
- Eksi işareti
+ Ya da artı işareti kullanılabilir.
```

1. İlk sıralı liste öğesi
2. Diğer bir öğe
  * Sırasız alt liste
1. Sayılar gerçekte önemsiz, bunun bir numara olması yeterli
  1. Sıralı alt liste
4. Ve bir başka öğe

   Liste öğeleri içerisinde girintili paragraf kullanabilirsiniz. Yukarıdan en az bir boş satır ve soldan en az bir boşluk bıraktığınıza emin olunuz. (burada hizalı gözükmesi amacıyla 3 boşluk kullanılmıştır, en az bir boşluk yeterlidir).

   Yeni paragrafa geçmeden satır sonu yapmak istiyorsanız, satırın sonunda 2 boşluk bırakınız.  
   Örneğin bu satırın aynı paragrafta ayrı bir satır olduğuna dikkat ediniz.  

* Sırasız liste yapmak için yıldız işareti
- Eksi işareti
+ Ya da artı işareti kullanılabilir.

<br>
<br>

<a name="baglantilar"/>
### Bağlantılar
</a>

```no-highlight
[Google'a bağlantı](https://www.google.com)

[Google'a bağlantı (başlıkla beraber)](https://www.google.com "Google'ın Ana Sayfası")

[Hedefi referanstan isim ile çeken bağlantı][YouTube'a referans]

[Hedefi referanstan sayı ile çeken bağlantı][1]

[Sitenin kök dizinine göre bağlantı](../t/HABER/)

ya da sol kısmı boş bıkarak direkt referansın kendisi: [Hepsiburada]

Ayrıca **telve.net**, direkt bağlantıları da otomatik olarak algılar: https://telve.net/

[YouTube'a referans]: https://www.youtube.com/
[1]: https://www.sahibinden.com/
[Hepsiburada]: http://www.hepsiburada.com/
```

[Google'a bağlantı](https://www.google.com)

[Google'a bağlantı (başlıkla beraber)](https://www.google.com "Google'ın Ana Sayfası")

[Hedefi referanstan isim ile çeken bağlantı][YouTube'a referans]

[Hedefi referanstan sayı ile çeken bağlantı][1]

[Sitenin kök dizinine göre bağlantı](../t/HABER/)

ya da sol kısmı boş bıkarak direkt referansın kendisi: [Hepsiburada]

Ayrıca **telve.net**, direkt bağlantıları da otomatik olarak algılar: https://telve.net/

[YouTube'a referans]: https://www.youtube.com/
[1]: https://www.sahibinden.com/
[Hepsiburada]: http://www.hepsiburada.com/

<br>
<br>

<a name="resimler"/>
### Resimler
</a>

```no-highlight
GitHub maskotlar (resmin üzerine gelerek başlığı görebilirsiniz):

Satır içi tarzı:
![alternatif metin](../assets/img/guide/GitHubLaborant.png "GitHub Maskot Laborant")

Referans tarzı:
![alternatif metin][github-maskot]

[github-maskot]: ../assets/img/guide/GitHubCouple.gif "GitHub Maskot Çift"

Ayrıca **telve.net**, direkt resim bağlantılarını da otomatik olarak algılar: https://telve.net/assets/img/misc/türk-kahvesi.jpg
```

GitHub maskotlar (resmin üzerine gelerek başlığı görebilirsiniz):

Satır içi tarzı:
![alternatif metin](../assets/img/guide/GitHubLaborant.png "GitHub Maskot Laborant")

Referans tarzı:
![alternatif metin][github-maskot]

[github-maskot]: ../assets/img/guide/GitHubCouple.gif "GitHub Maskot Çift"

Ayrıca **telve.net**, direkt resim bağlantılarını da otomatik olarak algılar: https://telve.net/assets/img/misc/türk-kahvesi.jpg

<br>
<br>

<a name="kod"/>
### Kod ve Sözdizimi Renklendirmesi
</a>

Kod blokları Markdown'ın özünde mevcut fakat sözdizimi renklendirmesi değil. **GitHub**, **Stack Overflow** gibi bilgisayar programcılarının sık ziyaret ettiği platformlar, programlama diline özgü sözdizimi renklendirmesini desteklemektedir. Fakat **telve.net** henüz sözdizimi renklendirmesini desteklememektedir.

Kod blokları burada biçimlendirilmemiş metin olarak da ifade edilebilir.

```no-highlight
Satırı içi `kod` yazılmak isteniyorsa `ters tırnak` kullanılır.
```

Satırı içi `kod` yazılmak isteniyorsa `ters tırnak` kullanılır.

Üç ters tırnak ` ``` ` ya da 4 boşluk karakteri ile girdi yaparak kodunuzu yazabilirsiniz:

Üçten geriye doğru sayan bir Python programı örneği:

    ```
    #!/usr/bin/python

    n = 3
    while (n > 0):
       print n
       n = n - 1

    print "telve.net!"
    ```

Mesajınız bu şekilde gözükecek:

```
#!/usr/bin/python

n = 3
while (n > 0):
   print n
   n = n - 1

print "telve.net!"
```

Programın çıktısını merak ediyorsanız:

```
3
2
1
telve.net!
```

<br>
<br>

<a name="tablolar"/>
### Tablolar
</a>

Tablolar Markdown'ın özünde mevcut olmasa da telve.net tabloları desteklenmektedir.

```no-highlight
İki nokta üst üste işaretleri kullanılarak sütunlar hizalanabilmektedir.

| Tablolar      | Çok           | Kullanışlı |
| ------------- |:-------------:| ----------:|
| sütun 3       |  sağa hizalı  |      $1600 |
| sütun 2       |  ortalanmış   |        $12 |
| zebra deseni  | göze faydalı  |         $1 |

Başlık hücrelerini diğer hücrelerden ayırmak için en az 3 çizgi kullanılmak zorundadır. Dış taraflardaki düz çizgiler opsiyoneldir ve tabloyu Markdown'a izah etmeniz için düzgünce yazmanıza gerek yoktur. Hücrelerin içlerinde Markdown'un diğer özelliklerini de aynen kullanabilirsiniz.

Markdown | Saçma da | Yazsanız
--- | --- | ---
*tablonuzu* | `düzgün` | **çizer**
1 | 2 | 3
```

İki nokta üst üste işaretleri kullanılarak sütunlar hizalanabilmektedir.

| Tablolar      | Çok           | Kullanışlı |
| ------------- |:-------------:| ----------:|
| sütun 3       |  sağa hizalı  |      $1600 |
| sütun 2       |  ortalanmış   |        $12 |
| zebra deseni  | göze faydalı  |         $1 |

<br>
Başlık hücrelerini diğer hücrelerden ayırmak için en az 3 çizgi kullanılmak zorundadır. Dış taraflardaki düz çizgiler opsiyoneldir ve tabloyu Markdown'a izah etmeniz için düzgünce yazmanıza gerek yoktur. Hücrelerin içlerinde Markdown'un diğer özelliklerini de aynen kullanabilirsiniz.

Markdown | Saçma da | Yazsanız
--- | --- | ---
*tablonuzu* | `düzgün` | **çizer**
1 | 2 | 3

<br>
<br>

<a name="alintilar"/>
### Alıntılar
</a>

```no-highlight
> Alıntılar özlü söz yapıştırmak için birebir :)
> Bu da aynı alıntının devamı.

Alıntının sonu. Diğer alıntıya başlamadan önce bir kaç kelime.

> Bu çok uzun bir satır ve buna rağmen tamamen doğru bir şekilde görüntülenir. İşte hal böyle olunca bizim kaynana çıldırdı, evi ateşe verdi falan neyse ben uzatmayım. Ha bir de; alıntıların içerisinde **Markdown'un** diğer *özelliklerini* de aynen kullanabilirsiniz.
```

> Alıntılar özlü söz yapıştırmak için birebir :)
> Bu da aynı alıntının devamı.

Alıntının sonu. Diğer alıntıya başlamadan önce birkaç kelime.

> Bu çok uzun bir satır ve buna rağmen tamamen doğru bir şekilde görüntülenir. İşte hal böyle olunca bizim kaynana çıldırdı, evi ateşe verdi falan neyse ben uzatmayım. Ha bir de; alıntıların içerisinde **Markdown'un** diğer *özelliklerini* de aynen kullanabilirsiniz.

<br>
<br>

<a name="html"/>
### Satır İçi HTML
</a>

Markdown içerisinde ayrıca düz HTML kodu kullanmanız da mümkün ve büyük ihtimalle de sorunsuzca çalışacaktır.

```no-highlight
<dl>
  <dt>Tanım listesi</dt>
  <dd>Bazen insanların kullanmak isteyebileceği birşey.</dd>

  <dt>Markdown içerisindeki HTML'in içerisinde Markdown</dt>
  <dd>*Pek* de **iyi** çalışmaz. HTML <em>etiketleri</em> kullansan daha <b>iyi</b>.</dd>
</dl>
```

<dl>
  <dt>Tanım listesi</dt>
  <dd>Bazen insanların kullanmak isteyebileceği birşey.</dd>

  <dt>Markdown içerisindeki HTML'in içerisinde Markdown</dt>
  <dd>*Pek* de **iyi** çalışmaz. HTML <em>etiketleri</em> kullansan daha <b>iyi</b>.</dd>
</dl>

<br>
<br>

<a name="yataycizgi"/>
### Yatay Çizgi
</a>

```
Üç ya da daha fazla...

---

Çizgi

***

Yıldız işareti

___

Altçizgi
```
<br>

Üç ya da daha fazla...

---

Çizgi

***

Yıldız işareti

___

Altçizgi

<br>
<br>

<a name="satirsonu"/>
### Satır Sonu
</a>

Markdown'daki satır sonu kavramını anlamak konusundaki tavsiyemiz deneyip görmeniz. Örneğin bir satır yazın &lt;Enter&gt;'a basın, sonra bir satır daha yazın iki kere &lt;Enter&gt;'a basın sonra bir satır yazın, gibi...

Deneyebileceğiniz bazı şeyler:

```
Başlangıç satırı.

Yukarıdakinden iki kere Enter'a basarak ayırılmış yeni bir satır, yani *ayrı bir paragraf*.

Bu satır yine yeni bir paragrafın başlangıcı, fakat...  
Bu sefer satır sonunda iki boşluk karakteri kullanılarak başlanmış yeni bir satır ama **aynı paragrafta**.

Alt alta bu şekilde.
Yazmanız yeni satıra geçmenizi.
Sağlamayacaktır.
Ancak satır sonunda iki boşluk kullanırsanız.  
Bir alt satıra geçer.
```

Başlangıç satırı.

Yukarıdakinden iki kere Enter'a basarak ayırılmış yeni bir satır, yani *ayrı bir paragraf*.

Bu satır yine yeni bir paragrafın başlangıcı, fakat...  
Bu sefer satır sonunda iki boşluk karakteri kullanılarak başlanmış yeni bir satır ama **aynı paragrafta**.

Alt alta bu şekilde.
Yazmanız yeni satıra geçmenizi.
Sağlamayacaktır.
Ancak satır sonunda iki boşluk kullanırsanız.  
Bir alt satıra geçer.

<br>
<br>

<a name="youtube"/>
### YouTube
</a>

```no-highlight
Ayrıca **telve.net**, girilen YouTube video bağlantılarını da otomatik olarak algılayıp videoyu gömecektir:

https://www.youtube.com/watch?v=9bZkp7q19f0

https://youtu.be/FrG4TEcSuRg
```

Ayrıca **telve.net**, girilen YouTube video bağlantılarını da otomatik olarak algılayıp videoyu gömecektir:

https://www.youtube.com/watch?v=9bZkp7q19f0

https://youtu.be/FrG4TEcSuRg

<br>
<br>

<a name="emojiler"/>
### Emojiler
</a>

Son olarak da **telve.net** tarafından desteklenen emojilerin tam listesi:

|                                   |                                           |                                               |                                   |
| :-------------------------------- | :---------------------------------------- | :-------------------------------------------- | :-------------------------------- |
| :gülümse: `:gülümse:` `:)`        | :gülücük: `:gülücük:` `:D` `:haha:`       | :sırıt: `:sırıt:`                             | :gülmektenağla: `:gülmektenağla:` |
| :hehe: `:hehe:`                   | :kahkaha: `:kahkaha:` `xD`                | :gözkırp: `:gözkırp:` `;)`                    | :utangaçgül: `:utangaçgül`        |
| :nefis: `:nefis:`                 | :artiz: `:artiz:` `:güneşgözlüğü:` `8|`   | :aşıkbak: `:aşıkbak:` `:gözlerkalp:`          | :kalpliöp: `:kalpliöp:` `:*`      |
| :öp: `:öp:`                       | :öpücük: `:öpücük:`                       | :utangaçöp: `:utangaçöp:`                     | :utan: `:utan:` `o.O` `utandım`   |
| :oh: `:oh:`                       | :dilçıkar: `:dilçıkar:` `:P`              | :uyu: `:uyu:`                                 | :zzz: `:zzz:`                     |
| :üzül: `:üzül:` `:(`              | :ney: `:ney:`                             | :O `:O`                                       | :tüh: `:tüh:`                     |
| :\| `:|`                          | -\_- `-_-`                                | :hıh: `:hıh:`                                 | :ağla: `:ağla` `:'(` `:çoküzül:`  |
| :olamaz: `:olamaz:`               | :sinirli: `:sinirli:` `:kızgın:`          | :öfkeli: `:öfkeli:`                           | :şeytan: `:şeytan:`               |
| :şeytanigül: `:şeytanigül:`       | :masum: `:masum:` `:melek:`               | :uzaylı: `:uzaylı:`                           | :sarıkalp: `:sarıkalp:`           |
| :mavikalp: `:mavikalp:`           | :morkalp: `:morkalp:`                     | :kalp: `:kalp:` `<3` `kırmızıkalp`:           | :yeşilkalp: `:yeşilkalp:`         |
| :kırıkkalp: `:kırıkkalp:`         | :pırıltılıkalp: `:pırıltılıkalp:`         | :aşktanrısı: `:aşktanrısı:`                   | :pırıltı: `:pırıltı:`             |
| :yıldız: `:yıldız:`               | :bom: `:bom:`                             | :müzik: `:müzik:`                             | :ateş: `:ateş:`                   |
| :kaka: `:kaka:` `:sıç:` `:bok:`   | :+1: `:+1:` `:beğen:` `:evet:`            | :-1: `:-1:` `:beğenme:` `:hayır:`             | :ok: `:ok:` `:tamam:`             |
| :yumruk: `:yumruk:`               | :zafer: `:zafer:`                         | :trol: `:trol:`                               | :github: `:github:`               |
| :yukarı: `:yukarı:`               | :aşağı: `:aşağı:`                         | :sol: `:sol:`                                 | :sağ: `:sağ:`                     |
| :dans: `:dans:`                   | :dua: `:dua:`                             | :alkış: `:alkış:`                             | :kas: `:kas:`                     |
| :metal: `:metal:`                 | :nah: `:nah:` `:ıIıı:` `:ortaparmak:`     | :kafatası: `:kafatası:` `:kurukafa:`          | :damla: `:damla:`                 |
| :burun: `:burun:`                 | :dil: `:dil:`                             | :göz: `:göz:`                                 | :kulak: `:kulak:`                 |
| :konuşmabalonu: `:konuşmabalonu:` | :düşünmebalonu: `:düşünmebalonu:`         | :türkiye: `:türkiye:` `:tc:` `:türkbayrağı:`  | :atatürk: `:atatürk:`             |
| :atatürk2: `:atatürk2:`           | :hediye: `:hediye:`                       | :altın: `:altın:`                             | :para: `:para:` `:dolar:`         |
| :euro: `:euro:`                   | :kredikartı: `:kredikartı:`               | :üniversite: `:üniversite:` `:üni:` `:viki:`  | :bulut: `:bulut:`                 |
| :güneş: `:güneş:` `:güneşli`      | :dünya: `:dünya:`                         | :yağmur: `:yağmur:`                           | :kar: `:kar:`                     |
|                                   |                                           |                                               |                                   |

<br>
<br>

Bu rehberi daha kısa yapamadığımız için üzgünüz. Alın size bir PatatesBot:

![](../assets/img/guide/PatatesBot.jpg)
