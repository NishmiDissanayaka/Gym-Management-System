import pandas as pd
import bar_chart_race as bcr
import shutil
import warnings


def build_sales_frame() -> pd.DataFrame:
    sales_millions = {
        "Year": list(range(2001, 2025)),
        "GTA III": [
            8.1, 14.5, 14.5, 14.5, 14.5, 14.5, 14.5, 14.5, 14.5, 14.5, 14.5, 14.5,
            14.5, 14.5, 14.5, 14.5, 14.5, 14.5, 14.5, 14.5, 14.5, 14.5, 14.5, 14.5
        ],
        "GTA Vice City": [
            0.0, 0.0, 6.4, 8.7, 10.2, 11.0, 11.3, 11.5, 11.5, 11.5, 11.5, 11.5,
            11.5, 11.5, 11.5, 11.5, 11.5, 11.5, 11.5, 11.5, 11.5, 11.5, 11.5, 11.5
        ],
        "GTA San Andreas": [
            0.0, 0.0, 0.0, 0.0, 7.8, 13.1, 17.8, 21.2, 24.0, 26.2, 27.4, 28.1,
            28.7, 29.2, 29.8, 30.3, 30.9, 31.4, 31.8, 32.2, 32.6, 33.0, 33.3, 33.6
        ],
        "GTA IV": [
            0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 3.6, 8.9, 12.6, 16.7, 19.1,
            21.0, 22.3, 23.5, 24.5, 25.4, 26.0, 26.7, 27.3, 27.8, 28.2, 28.5, 28.8
        ],
        "GTA V": [
            0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0,
            32.5, 45.0, 54.0, 65.0, 78.0, 95.0, 110.0, 130.0, 155.0, 175.0, 190.0, 205.0
        ],
    }
    frame_millions = pd.DataFrame(sales_millions).set_index("Year")
    frame_thousands = (frame_millions * 1000).round(0)
    return frame_thousands[frame_thousands.max(axis=1) > 0]


def summary(values, ranks):
    lead = values.idxmax()
    lead_value_millions = values.max() / 1000
    return {
        "x": 0.99,
        "y": 0.12,
        "s": f"Top seller: {lead}\n{lead_value_millions:,.1f}M copies (data unit: K)",
        "ha": "right",
        "size": 16,
        "weight": "bold",
        "color": "#f8f8f8",
    }


if __name__ == "__main__":
    warnings.filterwarnings(
        "ignore",
        message="set_ticklabels\\(\\) should only be used with a fixed number of ticks.*",
        category=UserWarning,
    )

    if shutil.which("ffmpeg") is None:
        raise SystemExit(
            "FFmpeg is not installed or not in PATH. Install FFmpeg and run `ffmpeg -version` first."
        )

    df = build_sales_frame()

    print("Preparing data in thousands of copies...")
    print(f"Estimated video length ≈ {(len(df) * 700) / 1000:.1f} seconds")
    print("Rendering 1080p animation...")

    bcr.bar_chart_race(
        df=df,
        filename="GTA_BarChartRace_1080p.mp4",
        orientation="h",
        sort="desc",
        n_bars=5,
        fixed_order=False,
        fixed_max=True,
        steps_per_period=25,
        interpolate_period=True,
        period_length=700,
        period_fmt="{x}",
        title="GTA Series Sales Growth (Thousands of Copies)",
        shared_fontdict={"family": "DejaVu Sans", "weight": "bold", "color": "#f8f8f8"},
        bar_size=0.9,
        figsize=(19.2, 10.8),
        dpi=100,
        cmap="Dark2",
        bar_kwargs={"alpha": 0.92, "linewidth": 0},
        tick_label_size=12,
        bar_label_size=12,
        period_label={"x": 0.99, "y": 0.98, "ha": "right", "va": "top", "size": 28},
        period_summary_func=summary,
        writer="ffmpeg",
        filter_column_colors=True,
    )

    print("Done: GTA_BarChartRace_1080p.mp4")
